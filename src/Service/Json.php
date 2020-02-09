<?php declare(strict_types=1);

namespace Arp\ContentNegotiation\Service;

use Arp\ContentNegotiation\Exception\ContentHandlerException;

/**
 * Handle the encoding/decoding of JSON content.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Service
 */
class Json extends AbstractContentHandler
{
    /**
     * @var array
     */
    protected $contentTypes = [
        'application/json',
    ];

    /**
     * @var array
     */
    private $encodeOptions;

    /**
     * @var array
     */
    private $decodeOptions;

    /**
     * @param array $contentTypes
     * @param array $encodeOptions
     * @param array $decodeOptions
     */
    public function __construct(array $contentTypes = [], array $encodeOptions = [], array $decodeOptions = [])
    {
        $this->encodeOptions = $encodeOptions;
        $this->decodeOptions = $decodeOptions;

        if (! empty($contentTypes)) {
            $this->setContentTypes($contentTypes);
        }
    }

    /**
     * Handle the encoding of request content.
     *
     * @param mixed $content The request content that should be encoded.
     * @param array $options The encoding options.
     *
     * @return string
     *
     * @throws ContentHandlerException  If the content cannot be encoded.
     */
    public function encode($content, array $options = []) : string
    {
        $options = array_replace_recursive($this->encodeOptions, $options);

        $encodeMaxDepth = $options['max_depth'] ?? 512;
        $encodeOptions  = $options['options'] ?? 0;

        try {
            return json_encode($content, $encodeOptions, $encodeMaxDepth);
        }
        catch (\Throwable $e) {
            throw new ContentHandlerException(
                sprintf('The JSON content could not be decoded : %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * Handle the response content.
     *
     * @param mixed $content The response content that should be decoded.
     * @param array $options Optional configuration options when handling the response content.
     *
     * @return mixed
     *
     * @throws ContentHandlerException  If the content cannot be decoded.
     */
    public function decode($content, array $options = [])
    {
        $options = array_replace_recursive($this->decodeOptions, $options);

        $decodeArray    = $options['as_array']  ?? true;
        $decodeMaxDepth = $options['max_depth'] ?? 512;
        $decodeOptions  = $options['options']   ?? 0;

        try {
            return json_decode($content, $decodeArray, $decodeMaxDepth, $decodeOptions);
        }
        catch (\Throwable $e) {
            throw new ContentHandlerException(
                sprintf('The JSON content could not be decoded : %s', $e->getMessage()),
                $e->getCode(),
                $e
            );
        }
    }
}