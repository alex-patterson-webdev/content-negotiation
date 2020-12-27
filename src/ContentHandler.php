<?php

declare(strict_types=1);

namespace Arp\ContentNegotiation;

use Arp\ContentNegotiation\Codec\CodecInterface;
use Arp\ContentNegotiation\Exception\CodecException;
use Arp\ContentNegotiation\Exception\ContentHandlerException;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation
 */
final class ContentHandler implements ContentHandlerInterface
{
    /**
     * @var CodecInterface
     */
    protected CodecInterface $codec;

    /**
     * @var string[]
     */
    protected array $contentTypes = [];

    /**
     * @param CodecInterface $codec
     * @param array          $contentTypes
     */
    public function __construct(CodecInterface $codec, array $contentTypes = [])
    {
        $this->codec = $codec;

        if (! empty($contentTypes)) {
            $this->setContentTypes($contentTypes);
        }
    }

    /**
     * @param mixed $content
     * @param array $options
     *
     * @return string
     *
     * @throws ContentHandlerException
     */
    public function encode($content, array $options = []): string
    {
        try {
            return $this->codec->encode($content, $options);
        } catch (CodecException $e) {
            throw new ContentHandlerException(
                sprintf('The content encoding failed: %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @param mixed $content
     * @param array $options
     *
     * @return mixed
     *
     * @throws ContentHandlerException
     */
    public function decode($content, array $options = [])
    {
        try {
            return $this->codec->decode($content, $options);
        } catch (CodecException $e) {
            throw new ContentHandlerException(
                sprintf('The content decoding failed: %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Check if the provided content type can be handled by this class.
     *
     * @param string $contentType
     *
     * @return boolean
     */
    public function isValid(string $contentType) : bool
    {
        if (in_array($contentType, $this->contentTypes, true)) {
            return true;
        }

        $contentType = strstr($contentType, ';', true);
        if (in_array($contentType, $this->contentTypes, true)) {
            return true;
        }

        return false;
    }

    /**
     * Set the content types.
     *
     * @param array $contentTypes  The content types.
     *
     * @return $this
     */
    public function setContentTypes(array $contentTypes) : self
    {
        $this->contentTypes = [];

        foreach($contentTypes as $contentType) {
            $this->addContentType($contentType);
        }

        return $this;
    }

    /**
     * Add a new content type to the collection.
     *
     * @param string  $contentType
     *
     * @return $this
     */
    public function addContentType(string $contentType) : self
    {
        if (! $this->isValid($contentType)) {
            $this->contentTypes[] = $contentType;
        }

        return $this;
    }
}
