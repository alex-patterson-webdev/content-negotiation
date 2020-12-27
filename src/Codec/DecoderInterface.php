<?php

declare(strict_types=1);

namespace Arp\ContentNegotiation\Codec;

use Arp\ContentNegotiation\Exception\ContentDecodingException;

/**
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Codec
 */
interface DecoderInterface
{
    /**
     * @param mixed $content The content that should be decoded
     * @param array $options Decoding options
     *
     * @return mixed
     *
     * @throws ContentDecodingException
     */
    public function decode($content, array $options = []);
}
