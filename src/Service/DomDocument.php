<?php

namespace Arp\ContentNegotiation\Service;

/**
 * Manage the encoding of a DOMDocument and decoding back into a HTML string.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Service
 */
class DomDocument extends AbstractContentHandler
{
    /**
     * @var array
     */
    protected $contentTypes = [
        'text/html',
    ];

    /**
     * Encode the HTML document
     *
     * @param mixed $content
     * @param array $options
     *
     * @return string
     */
    public function encode($content, array $options = []) : string
    {
        if ($content instanceof \DOMDocument) {
            $content = $content->saveHTML();
        }

        return $content;
    }

    /**
     * Decode a HTML document.
     *
     * @param mixed $content
     * @param array $options
     *
     * @return mixed|void
     */
    public function decode($content, array $options = [])
    {
        if (is_string($content)) {
            $document = new \DOMDocument();
            $document->loadHTML($content);
            $content = $document;
        }
        return $content;
    }
}