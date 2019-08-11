<?php

namespace Arp\ContentNegotiation\Service;

use Arp\ContentNegotiation\Exception\ContentTypeHandlerException;

/**
 * Xml
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Spectrum\ApiClient\Service
 */
class Xml extends AbstractContentTypeHandler
{
    /**
     * isValidContentType
     *
     * Check if the provided content type can be handled by this class.
     *
     * @param string $contentType
     *
     * @return boolean
     */
    public function isValid(string $contentType) : bool
    {
        return false;
    }

    /**
     * encode
     *
     * Handle the encoding of request content.
     *
     * @param mixed $content The request content that should be encoded.
     * @param array $options The encoding options.
     *
     * @return mixed
     *
     * @throws ContentTypeHandlerException  If the content cannot be decoded.
     */
    public function encode($content, array $options = [])
    {

    }

    /**
     * decode
     *
     * Handle the response content.
     *
     * @param mixed $content The response content that should be decoded.
     * @param array $options Optional configuration options when handling the response content.
     *
     * @return mixed
     *
     * @throws ContentTypeHandlerException  If the content cannot be decoded.
     */
    public function decode($content, array $options = [])
    {

    }

}