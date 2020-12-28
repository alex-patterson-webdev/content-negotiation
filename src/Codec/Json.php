<?php

declare(strict_types=1);

namespace Arp\ContentNegotiation\Codec;

use Arp\ContentNegotiation\Exception\ContentDecodingException;
use Arp\ContentNegotiation\Exception\ContentEncodingException;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Codec
 */
final class Json implements CodecInterface
{
    /**
     * @var array
     */
    private array $encodeOptions;

    /**
     * @var array
     */
    private array $decodeOptions;

    /**
     * @param array $encodeOptions
     * @param array $decodeOptions
     */
    public function __construct(array $encodeOptions = [], array $decodeOptions = [])
    {
        $this->encodeOptions = $encodeOptions;
        $this->decodeOptions = $decodeOptions;
    }

    /**
     * @param mixed $content
     * @param array $options
     *
     * @return string
     *
     * @throws ContentEncodingException
     */
    public function encode($content, array $options = []): string
    {
        $options = array_replace_recursive($this->encodeOptions, $options);

        try {
            /** @noinspection JsonEncodingApiUsageInspection */
            return json_encode(
                $content,
                $options['options'] ?? 0,
                $options['depth'] ?? 512
            );
        } catch (\Throwable $e) {
            throw new ContentEncodingException(
                sprintf('The JSON content could not be decoded : %s', $e->getMessage()),
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
     * @throws ContentDecodingException
     */
    public function decode($content, array $options = [])
    {
        $options = array_replace_recursive($this->decodeOptions, $options);

        try {
            /** @noinspection JsonEncodingApiUsageInspection */
            return json_decode(
                $content,
                (isset($options['assoc']) && true === $options['assoc']),
                $options['depth'] ?? 512,
                $options['options'] ?? 0
            );
        } catch (\Throwable $e) {
            throw new ContentDecodingException(
                sprintf('The JSON content could not be decoded : %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }
}
