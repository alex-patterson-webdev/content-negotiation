<?php declare(strict_types=1);

namespace Arp\ContentNegotiation\Service;

/**
 * AbstractContentHandler
 *
 * @author  Alex Patterson <alex.patterson.webdev@gmail.com>
 * @package Arp\ContentNegotiation\Service
 */
abstract class AbstractContentHandler implements ContentHandlerInterface
{
    /**
     * @var string[]
     */
    protected $contentTypes = [];

    /**
     * Check if the provided content type can be handled by this class.
     *
     * @param string $contentType
     *
     * @return boolean
     */
    public function isValid(string $contentType) : bool
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
     * Add a new content type to the collection.
     *
     * @param string  $contentType
     *
     * @return $this
     */
    public function addContentType(string $contentType) : self
    {
        if (! $this->isValid($contentType)) {
            $this->contentTypes[] = $contentType;
        }

        return $this;
    }
}