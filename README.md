LZAztecNotificationBundle
=========================

This bundle provides intergration with a [Dklab Realplexor](https://github.com/DmitryKoterov/dklab_realplexor) (or other) comet server

### Installation

For Symfony 2.0.x:

add to your application `deps` file:

```ini
[DklabRealplexor]
    git=https://github.com/DmitryKoterov/dklab_realplexor.git
    target=/Dklab/Reaplexor

[LZAztecNotificationBundle]
    git=https://github.com/LZAztec/LZAztecNotificationBundle.git
    target=/bundles/LZAztec/NotificationBundle
```

add to your apllication `AppKernel.php` file:
```php

    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new LZAztec\NotificationBundle\LZAztecNotificationBundle(),
            // ...
        );
    }
```

add to your apllication `autoload.php` file:
```php

    // app/autoload.php

    $loader->registerNamespaces(array(
        // ...
        'LZAztec'                 => __DIR__.'/../vendor/bundles',
    ));

    $loader->registerPrefixes(array(
        // ...
        // Load realplexor api
        'Dklab_'         => __DIR__.'/../vendor/Dklab/Reaplexor/api/php',
    ));
```

### Configuration

```yml
lz_aztec_notification:
    realplexor_ns: demo_               # Realplexor namespace to use (allowed alphanumeric characters and the underscore character)
    js_api_host: notify.localhost      # JS API host to listen for notifications
```