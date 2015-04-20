# velocity-service

## Using

To use velocity service provider you need to inject values:

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


