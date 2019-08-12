<?php

namespace Arp\ContentNegotiation\Service;

use Arp\Stdlib\Service\OptionsAwareInterface;
use Arp\Stdlib\Service\OptionsAwareTrait;

/**
 * AbstractContentTypeHandler
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Service
 */
abstract class AbstractContentTypeHandler implements ContentTypeHandlerInterface, OptionsAwareInterface
{
    /**
     * @trait OptionsAwareTrait
     */
    use OptionsAwareTrait;

    /**
     * $contentTypes
     *
     * @var array
     */
    protected $contentTypes = [];

    /**
     * __construct
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (! empty($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * hasContentType
     *
     * Check if the content type exists within the collection.
     *
     * @param string  $contentType
     *
     * @return boolean
     */
    public function hasContentType(string $contentType) : bool
    {
        if (in_array($contentType, $this->contentTypes, true)) {
            return true;
        }

        $contentType = strstr($contentType, ';', true);

        if (in_array($contentType, $this->contentTypes, true)) {
            return true;
        }

        return false;
    }

    /**
     * getContentTypes
     *
     * Return the content types.
     *
     * @return array
     */
    public function getContentTypes() : array
    {
        return $this->contentTypes;
    }

    /**
     * setContentTypes
     *
     * Set the content types.
     *
     * @param array $contentTypes  The content types.
     *
     * @return $this
     */
    public function setContentTypes(array $contentTypes) : self
    {
        $this->contentTypes = [];

        foreach($contentTypes as $contentType) {
            $this->addContentType($contentType);
        }

        return $this;
    }

    /**
     * addContentType
     *
     * Add a new content type to the collection.
     *
     * @param string  $contentType
     *
     * @return $this
     */
    public function addContentType(string $contentType) : self
    {
        if (! $this->hasContentType($contentType)) {
            $this->contentTypes[] = $contentType;
        }

        return $this;
    }

}