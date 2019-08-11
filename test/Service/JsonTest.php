<?php

namespace ArpTest\ContentNegotiation\Service;

use Arp\ContentNegotiation\Service\ContentTypeHandlerInterface;
use Arp\ContentNegotiation\Service\Json;
use PHPUnit\Framework\TestCase;

/**
 * JsonTest
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\ContentNegotiation\Service
 */
class JsonTest extends TestCase
{
    /**
     * testImplementsContentTypeHandlerInterface
     *
     * Ensure the class implements ContentTypeHandlerInterface.
     *
     * @test
     */
    public function testImplementsContentTypeHandlerInterface()
    {
        $handler = new Json();

        $this->assertInstanceOf(ContentTypeHandlerInterface::class, $handler);
    }

}