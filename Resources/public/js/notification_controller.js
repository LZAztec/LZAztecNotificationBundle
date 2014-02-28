/**
 * Класс работы с уведомлениями
 * @param settings
 * @returns {TabsController}
 * @constructor
 */
var NotificationController = function(settings)
{
    if (typeof jQuery == 'undefined')
    {
        throw new Error('jQuery not found!');
    }

    /* Вызвать как конструктор */
    if (!(this instanceof NotificationController)) {
        return new NotificationController(settings);
    }

    this.settings = $.extend(this.defaults, settings);
    this.initAdapter();
};

NotificationController.prototype =
{
    adapter: null,

    callbacks: {},

    /**
     * Default settings
     */
    defaults:
    {
        notificationService: 'realplexor',
        host: null,
        namespace: null,
        channels: []
    },

    /**
     * Current settings
     */
    settings: {},

    initAdapter: function()
    {
        this.adapter = new RealplexorAdapter(this.settings);
    },

    subscribeChannel: function(channel)
    {
        var callback = this.getChannelCallback(channel);
        if (typeof callback == 'function')
        {
            this.adapter.subscribe(channel, callback);
        }
    },

    extractChannelType: function (channel)
    {
        return this.extractChannelNamePart(channel, 1);
    },

    extractEntityName: function (channel)
    {
        return this.extractChannelNamePart(channel, 0);
    },

    extractChannelNamePart: function(channel, part)
    {
        return channel.split('_')[part];
    },

    getChannelCallback: function(channel)
    {
        var channelType = this.extractChannelType(channel),
            entityName = this.extractEntityName(channel);

        if (typeof this.callbacks[entityName] == 'function')
        {
            return new this.callbacks[entityName](channelType);
        }
        return null;
    },

    registerCallback: function(entityName, callback)
    {
        if (typeof callback != 'function')
        {
            throw new Error('Callback must be a function. ' + typeof callback + ' given.');
        }
        this.callbacks[entityName] = callback;
    },

    startListen: function(){
        this.adapter.startListen();
    }
};

/**
 * Callback prototype
 */
NotificationCallbackPrototype =
{
    channelType: null,

    defaultCallback: function()
    {
        throw new Error('Callback is not defined for channel "'+ this.channelType + '"');
    },

    makeCallback: function(channelType)
    {
        if (typeof channelType != 'string')
        {
            channelType = this.channelType
        }

        if (channelType in this)
        {
            return this[channelType].bind(this);
        }

        return this.defaultCallback();
    }
}

/**
 * Абстрактный адаптер
 * @param settings
 * @constructor
 */
function AbstractAdapter(settings)
{
    this.settings = $.extend(this.defaults, settings);
}
AbstractAdapter.prototype =
{
    constructor: AbstractAdapter,
    defaults: {
        host: 'localhost',
        namespace: 'sm_'
    },
    instance: null
}

/**
 * Realplexor adapter
 * @param settings
 * @constructor
 */
function RealplexorAdapter(settings)
{
    AbstractAdapter.call(this, settings);

    this.instance = new Dklab_Realplexor(
        this.settings.host,  // Realplexor's engine URL; must be a sub-domain
        this.settings.namespace // namespace
    );
}

RealplexorAdapter.prototype =
{
    constructor: RealplexorAdapter,

    subscribe: function(channel, callback)
    {
        // Subscribe a callback to channel Alpha.
        this.instance.subscribe(channel, callback);
        // todo add logging
//        console.log('Channel "' + channel + '" subscribed');
    },

    unsubscribe: function(channel, callback)
    {
        this.instance.unsubscribe(channel, callback);
        // todo add logging
//        console.log('Channel "' + channel + '" unsubscribed');
    },

    startListen: function()
    {
        // Apply subscriptions. Сallbacks are called asynchronously on data arrival.
        this.instance.execute();
    }
}

$.extend(true, RealplexorAdapter.prototype, AbstractAdapter.prototype);
