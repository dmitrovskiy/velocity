# velocity-service

## Using

To use velocity service provider you need to inject values:

```php
$app = new Application();

$injectionData =
    array(
        'velocity.identityToken' => 'yourToken',
        'velocity.applicationProfileId' => 1234,
        'velocity.merchantProfileId' => 'merchantProfileId',
        'velocity.workflowId' => 123456789,
        'velocity.isTestAccount' => true
    );

    foreach($injectionData as $injectionKey => $injectionValue)
    {
        $app[$injectionKey] = $injectionValue;
    }
```
The value `velocity.isTestAccount` is optional and false by default.
After registering the service you be able to use `velocity.processor` to communicate with velocity service.


