<?php

namespace FluentdHandler;

use Fluent\Logger\FluentLogger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

/**
 * Handler to send messages to a Fluentd (http://www.fluentd.org/) server
 *
 * Requires https://github.com/fluent/fluent-logger-php
 *
 * @author Yegor Tokmakov <yegor@tokmakov.biz>
 */
class FluentdHandler extends AbstractProcessingHandler
{
    /**
     * @var FluentLogger
     */
    private $logger;

    /**
     * Initialize Handler
     *
     * @param FluentLogger $logger
     * @param bool|int     $level
     * @param bool         $bubble
     */
    public function __construct(
        FluentLogger $logger = null,
        $level  = Logger::DEBUG,
        $bubble = true
    )
    {
        parent::__construct($level, $bubble);

        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record)
    {
        $data = $record['context'];
        $data['level'] = Logger::getLevelName($record['level']);
        $data['message'] = $record['message'];

        $this->logger->post($record['channel'], $data);
    }
}