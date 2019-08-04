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
     * isValid
     *
     * @param string $contentType
     *
     * @return mixed
     */
    public function isValid($contentType)
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