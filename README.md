LZAztecNotificationBundle
=========================

This bundle provides intergration with a Dklab Realplexor (or other) comet server

### Installation

#### Bundle and Dependencies

For Symfony 2.0.x:

add to your application `deps` file:

```ini
[DklabRealplexor]
    git=https://github.com/DmitryKoterov/dklab_realplexor.git
    target=/Dklab/Reaplexor

[LZAztecNotificationBundle]
    git=https://github.com/LZAztec/LZAztecNotificationBundle.git
    target=/bundles/LZAztec/LZAztecNotificationBundle
```

add to your apllication `AppKernel.php` file:
```php
 public function registerBundles()
    {
        $bundles = array(
            // ...
            new LZAztec\LZAztecNotificationBundle\LZAztecNotificationBundle(),
        );
```

add to your apllication `autoload.php` file:
```php
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
