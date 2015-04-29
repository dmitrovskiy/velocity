<?php

namespace Dmitrovskiy\VelocityService;

use Dmitrovskiy\VelocityService\Exception\ConfigValueNotExistException;
use Silex\Application;
use Silex\ServiceProviderInterface;

require_once __DIR__ . '/sdk/Velocity.php';

/**
 * Class VelocityServiceProvider
 *
 * @package Dmitrovskiy\VelocityService
 */
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
                    /** @var VelocityProcessorFactory $velocityProcessorFactory */
                    $velocityProcessorFactory
                        = $app['velocity.processor.factory'];
                    return $velocityProcessorFactory->getProcessor(
                        $app['velocity.applicationProfileId'],
                        $app['velocity.merchantProfileId'],
                        $app['velocity.workflowId'],
                        $app['velocity.identityToken'],
                        $app['velocity.isTestAccount']
                    );
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
            }
        );

        $app['velocity.processor.factory'] = $app->share(
            function () use ($app) {
                return new VelocityProcessorFactory();
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
