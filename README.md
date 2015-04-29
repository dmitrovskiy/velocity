# velocity-service

## Using

### Single velocity processor

To use it in your project you should add the package `"dmitrovskiy/velocityservice": "dev-master"` into your `composer.json` file.

Before using velocity service provider you need to inject values:

```php
$app = new Application();

$app->register(new VelocityServiceProvider(), array(
    'velocity.identityToken' => 'yourToken',
    'velocity.applicationProfileId' => 1234,
    'velocity.merchantProfileId' => 'yourMerchantProfileID',
    'velocity.workflowId' => 1234565,
    'velocity.isTestAccount' => true
));
```
The value `velocity.isTestAccount` is optional and false by default.

After registering the service you be able to use `$app['velocity.processor']` to communicate with velocity service.

### Velocity processor factory

That to use several instances of velocity processor you need `$app['velocity.processor.factory']`.

```php
$applicationProfileId = 14644;
$merchantProfileId = "Test Merchant HC";
$workflowId = 2317000001;
$identityToken = 'yourToken';
$isTestAccount = true;

$velocityProcessorFactory = $app['velocity.processor.factory'];

$processor = $velocityProcessorFactory->getProcessor(
    $applicationProfileId,
    $merchantProfileId,
    $workflowId,
    $identityToken,
    $isTestAccount
);
```


