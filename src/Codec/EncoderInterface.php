<?php

declare(strict_types=1);

namespace Arp\ContentNegotiation\Codec;

use Arp\ContentNegotiation\Exception\ContentEncodingException;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Codec
 */
interface EncoderInterface
{
    /**
     * @param mixed $content The content that should be encoded.
     * @param array $options Encoding options.
     *
     * @return string
     *
     * @throws ContentEncodingException
     */
    public function encode($content, array $options = []): string;
}
