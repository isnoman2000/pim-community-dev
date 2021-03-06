<?php

namespace Pim\Bundle\CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Pim\Bundle\CatalogBundle\Model\ProductValueInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Media
 *
 * @author    Gildas Quemener <gildas@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * @ORM\Table(name="pim_catalog_media")
 * @ORM\Entity
 */
class Media
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * File uploaded in form
     *
     * @var \Symfony\Component\HttpFoundation\File\File $file
     */
    protected $file;

    /**
     * Filename
     *
     * @var string $filename
     *
     * @ORM\Column(name="filename", type="string", length=255, unique=true, nullable=true)
     */
    protected $filename;

    /**
     * File path
     *
     * @var string $filePath
     *
     * @ORM\Column(name="filepath", type="string", length=255, unique=true, nullable=true)
     */
    protected $filePath;

    /**
     * Original file name
     *
     * @var string $originalFilename
     *
     * @ORM\Column(nullable=true)
     */
    protected $originalFilename;

    /**
     * Mime type
     *
     * @var string $mimeType
     *
     * @ORM\Column(name="mimeType", type="string", length=255, nullable=true)
     */
    protected $mimeType;

    /**
     * @ORM\OneToOne(
     *     targetEntity="Pim\Bundle\CatalogBundle\Model\ProductValueInterface",
     *     mappedBy="media"
     * )
     * @ORM\JoinColumn(name="value_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $value;

    protected $removed = false;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Media
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Symfony\Component\HttpFoundation\File\File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param \Symfony\Component\HttpFoundation\File\File $file
     *
     * @return Media
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Media
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get file path
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * Set file path
     *
     * @param string $filePath
     *
     * @return Media
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Get original filename
     *
     * @return string
     */
    public function getOriginalFilename()
    {
        return $this->originalFilename;
    }

    /**
     * Set original filename
     *
     * @param string $originalFilename
     *
     * @return Media
     */
    public function setOriginalFilename($originalFilename)
    {
        $this->originalFilename = $originalFilename;

        return $this;
    }

    /**
     * Get mime type
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set mime type
     *
     * @param string $mimeType
     *
     * @return Media
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * @param boolean $removed
     */
    public function setRemoved($removed)
    {
        $this->removed = $removed;
    }

    /**
     * @return boolean
     */
    public function isRemoved()
    {
        return $this->removed;
    }

    /**
     * Set the product value
     *
     * @param ProductValueInterface $value
     *
     * @return Media
     */
    public function setValue(ProductValueInterface $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the product value
     *
     * @return ProductValueInterface
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->filename;
    }
}
