<?php

declare(strict_types=1);

namespace ArpTest\ContentNegotiation;

use Arp\ContentNegotiation\Codec\CodecInterface;
use Arp\ContentNegotiation\ContentHandler;
use Arp\ContentNegotiation\ContentHandlerInterface;
use Arp\ContentNegotiation\Exception\ContentHandlerException;
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

    /**
     * @throws ContentHandlerException
     *
     * @throws \JsonException
     */
    public function testEncodeWillProxyToCodecEncode(): void
    {
        $handler = new ContentHandler($this->codec, []);

        $content = [
            'test' => 'This is some example content',
            'hello' => 123,
        ];

        $options = [
            'foo' => 'test',
            'bar' => true,
        ];

        $encodedContent = json_encode($content, JSON_THROW_ON_ERROR);

        $this->codec->expects($this->once())
            ->method('encode')
            ->with($content, $options)
            ->willReturn($encodedContent);

        $this->assertSame($encodedContent, $handler->encode($content, $options));
    }
}
