<?php

declare(strict_types=1);

namespace Arp\ContentNegotiation;

use Arp\ContentNegotiation\Exception\ContentHandlerException;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation
 */
interface ContentHandlerInterface
{
    /**
     * @param string $contentType
     *
     * @return boolean
     */
    public function isValid(string $contentType) : bool;

    /**
     * @param mixed $content
     * @param array $options
     *
     * @return string
     *
     * @throws ContentHandlerException
     */
    public function encode($content, array $options = []): string;

    /**
     * @param mixed $content
     * @param array $options
     *
     * @return mixed
     *
     * @throws ContentHandlerException
     */
    public function decode($content, array $options = []);
}
