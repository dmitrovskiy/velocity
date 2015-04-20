<?php

namespace Dmitrovskiy\VelocityService;

use Dmitrovskiy\VelocityService\Exception\ConfigValueNotExistException;
use Silex\Application;
use Silex\ServiceProviderInterface;

require_once __DIR__ . '/sdk/Velocity.php';

class VelocityServiceProvider implements ServiceProviderInterface
{
    protected $injectionList
        = array(
            'velocity.identityToken',
            'velocity.applicationProfileId',
            'velocity.merchantProfileId',
            'velocity.workflowId'
        );

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     */
    public function register(Application $app)
    {
        $app['velocity.isTestAccount']
            = isset($app['velocity.isTestAccount']) ?: false;

        $app['velocity.processor'] = $app->share(
            function () use ($app) {
                $this->validateInjectingValues($app);

                try {
                    return new \VelocityProcessor(
                        $app['velocity.applicationProfileId'],
                        $app['velocity.merchantProfileId'],
                        $app['velocity.workflowId'],
                        $app['velocity.isTestAccount'],
                        $app['velocity.identityToken']
                    );
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
            }
        );
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }

    protected function validateInjectingValues($app)
    {
        foreach ($this->injectionList as $injectionItem) {
            if (!isset($app[$injectionItem])) {
                throw new ConfigValueNotExistException(
                    "Config value $injectionItem doesn't exist while setting up the application"
                );
            }
        }
    }
}
