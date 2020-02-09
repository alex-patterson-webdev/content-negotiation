<?php declare(strict_types=1);

namespace Arp\ContentNegotiation\Service;

/**
 * Html
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Service
 */
class Html extends AbstractContentHandler
{
    /**
     * Handle the encoding of request content.
     *
     * @param mixed $content The request content that should be encoded.
     * @param array $options The encoding options.
     *
     * @return string
     */
    public function encode($content, array $options = []) : string
    {
        return $content;
    }

    /**
     * Handle the response content.
     *
     * @param mixed $content The response content that should be decoded.
     * @param array $options Optional configuration options when handling the response content.
     *
     * @return mixed
     */
    public function decode($content, array $options = [])
    {
        return $content;
    }
}