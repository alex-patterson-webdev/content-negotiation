<?php

namespace Arp\ContentNegotiation\Service;

/**
 * Html
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Service
 */
class Html extends AbstractContentTypeHandler
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
        return $this->hasContentType($contentType);
    }

    /**
     * encode
     *
     * @param mixed $content
     * @param array $options
     *
     * @return mixed
     */
    public function encode($content, array $options = [])
    {
        return $content;
    }

    /**
     * decode
     *
     * @param mixed $content
     * @param array $options
     *
     * @return mixed
     */
    public function decode($content, array $options = [])
    {
        return $content;
    }

}