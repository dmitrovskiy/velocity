<?php

namespace Dmitrovskiy\VelocityService\Tests;

use Dmitrovskiy\VelocityService\VelocityServiceProvider;
use Silex\Application;

/**
 * Class VelocityServiceProviderTest
 *
 * @package Dmitrovskiy\VelocityService\Tests
 */
class VelocityServiceProviderTest extends TestCase
{
    /** @var  Application */
    protected $app;

    protected function injectToApp()
    {
        $injectionData = array(
            'velocity.identityToken' => 'identityToken',
            'velocity.applicationProfileId' => 1234,
            'velocity.merchantProfileId' => 'merchantProfileId',
            'velocity.workflowId' => 123456789,
            'velocity.isTestAccount' => true
        );

        foreach($injectionData as $injectionKey => $injectionValue)
        {
            $this->app[$injectionKey] = $injectionValue;
        }
    }

    public function setUp()
    {
        $this->app = new Application();
    }

    public function tearDown()
    {
        unset($this->app);
    }

    public function testInjectionRegistering()
    {
        $this->injectToApp();
        $this->app->register(new VelocityServiceProvider());

        $this->assertNotEmpty($this->app['velocity.processor']);
    }

    /**
     * @expectedException Dmitrovskiy\VelocityService\Exception\ConfigValueNotExistException
     */
    public function testFailedConfigSetup()
    {
        $this->app->register(new VelocityServiceProvider());

        $this->app['velocity.processor'];
    }
}