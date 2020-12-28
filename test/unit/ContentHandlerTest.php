<?php

declare(strict_types=1);

namespace ArpTest\ContentNegotiation;

use Arp\ContentNegotiation\Codec\CodecInterface;
use Arp\ContentNegotiation\ContentHandler;
use Arp\ContentNegotiation\ContentHandlerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Arp\ContentNegotiation\ContentHandler
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package ArpTest\ContentNegotiation
 */
final class ContentHandlerTest extends TestCase
{
    /**
     * @var CodecInterface|MockObject
     */
    private $codec;

    /**
     * Prepare the test case dependencies
     */
    public function setUp(): void
    {
        $this->codec = $this->getMockForAbstractClass(CodecInterface::class);
    }

    /**
     * Assert that the handler implement ContentHandlerInterface
     */
    public function testImplementsContentHandlerInterface(): void
    {
        $handler = new ContentHandler($this->codec, []);

        $this->assertInstanceOf(ContentHandlerInterface::class, $handler);
    }
}
