<?php declare(strict_types=1);

namespace Arp\ContentNegotiation\Service;

use Arp\ContentNegotiation\Exception\ContentHandlerException;

/**
 * Abstraction of the content type validation and encoding/decoding of the content.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Service
 */
interface ContentHandlerInterface
{
    /**
     * Check if the provided content type can be handled by this class.
     *
     * @param string $contentType
     *
     * @return boolean
     */
    public function isValid(string $contentType) : bool;

    /**
     * Handle the encoding of request content.
     *
     * @param mixed $content The request content that should be encoded.
     * @param array $options The encoding options.
     *
     * @return string
     *
     * @throws ContentHandlerException  If the content cannot be decoded.
     */
    public function encode($content, array $options = []) : string;

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
    public function decode($content, array $options = []);
}