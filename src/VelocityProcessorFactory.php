<?php

namespace Dmitrovskiy\VelocityService;

require_once __DIR__ . '/sdk/Velocity.php';

/**
 * Class VelocityProcessorFactory
 *
 * @package Dmitrovskiy\VelocityService
 */
class VelocityProcessorFactory
{
    /**
     * @param string $applicationProfileId
     * @param string $merchantProfileId
     * @param string $workflowId
     * @param string $identityToken
     * @param bool   $isTestAccount
     *
     * @return \VelocityProcessor
     */
    public function getProcessor($applicationProfileId, $merchantProfileId,
        $workflowId, $identityToken, $isTestAccount = false
    ) {
        return new \VelocityProcessor(
            $applicationProfileId, $merchantProfileId, $workflowId,
            $isTestAccount, $identityToken
        );
    }
}