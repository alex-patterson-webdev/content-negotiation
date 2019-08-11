<?php

namespace Arp\ContentNegotiation\Service;

use Arp\ContentNegotiation\Exception\ContentTypeHandlerException;
use Zend\Json\Exception\ExceptionInterface;
use Zend\Json\Json as ZendJson;

/**
 * Json
 *
 * Handle the encoding/decoding of Json content type's.
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Service
 */
class Json extends AbstractContentTypeHandler
{
    /**
     * $json
     *
     * @var ZendJson
     */
    protected $json;

    /**
     * $decodeType
     *
     * @var integer
     */
    protected $decodeType = ZendJson::TYPE_ARRAY;

    /**
     * __construct
     *
     * @param array  $contentTypes  The types of contents that can be
     * @param array  $options       The content handler options.
     */
    public function __construct(array $contentTypes = [], array $options = [])
    {
        $this->json = isset($options['json']) ? $options['json'] : false;

        if (! $this->json instanceof ZendJson) {
            $this->json = new ZendJson;
        }

        parent::__construct($contentTypes, $options);
    }

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
     * Handle the encoding of request content.
     *
     * @param mixed  $content  The request content that should be encoded.
     * @param array  $options  The optional encoding options.
     *
     * @return mixed
     *
     * @throws ContentTypeHandlerException  If the content cannot be encoded.
     */
    public function encode($content, array $options = [])
    {
        if (! empty($options)) {
            $this->addOptions($options);
        }

        $cycleCheck = $this->getOption('cycle_check', false);
        $options = [
            'enableJsonExprFinder' => false,
            'prettyPrint'          => $this->getOption('pretty_print', false)
        ];

        try {
            return $this->json->encode($content, $cycleCheck, $options);
        }
        catch (\Exception $e) {

            throw new ContentTypeHandlerException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * decode
     *
     * Handle decoding of the response content.
     *
     * @param mixed  $content  The response content that should be decoded.
     * @param array  $options  Optional configuration options when handling the response content.
     *
     * @return string
     *
     * @throws ContentTypeHandlerException  If the content cannot be decoded.
     */
    public function decode($content, array $options = [])
    {
        if (! empty($options)) {
            $this->addOptions($options);
        }

        $decodeType = $this->getOption('decode_type', ZendJson::TYPE_ARRAY);

        try {
            return $this->json->decode($content, $decodeType);

        } catch (ExceptionInterface $e) {

            throw new ContentTypeHandlerException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * setContentTypes
     *
     * Set the content types that are valid for this handler.
     *
     * @param array $contentTypes  The content types that are valid.
     *
     * @return $this
     */
    public function setContentTypes(array $contentTypes)
    {
        $this->contentTypes = $contentTypes;

        return $this;
    }

}