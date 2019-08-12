<?php

namespace ArpTest\ContentNegotiation\Service;

use Zend\Json\Json as ZendJson;
use Arp\ContentNegotiation\Service\ContentTypeHandlerInterface;
use Arp\ContentNegotiation\Service\Json;
use PHPUnit\Framework\MockObject\MockObject;
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
     * $json
     *
     * @var ZendJson|MockObject
     */
    protected $json;

    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->json = $this->createMock(ZendJson::class);
    }

    /**
     * testImplementsContentTypeHandlerInterface
     *
     * Ensure the class implements ContentTypeHandlerInterface.
     *
     * @test
     */
    public function testImplementsContentTypeHandlerInterface()
    {
        $handler = new Json($this->json);

        $this->assertInstanceOf(ContentTypeHandlerInterface::class, $handler);
    }

}