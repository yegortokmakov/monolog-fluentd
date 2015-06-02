<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FluentdHandler;

use Monolog\Logger;
use Monolog\TestCase;

/**
 * @covers FluentdHandler\FluentdHandler
 */
class FluentdHandlerTest extends TestCase
{
    public function testWrite()
    {
        $fluentLogger = $this->getMock('Fluent\Logger\FluentLogger', array(), array(), '', false);

        $record = $this->getRecord();

        $expectedContext = $record['context'];
        $expectedContext['level'] = Logger::getLevelName($record['level']);
        $expectedContext['message'] = $record['message'];

        $fluentLogger->expects($this->once())->method('post')->with($record['channel'], $expectedContext);

        $handler = new FluentdHandler($fluentLogger);
        $handler->handle($record);
    }
}