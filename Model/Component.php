<?php
/**
 * @package atipso_dev
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 16.03.14
 * @time 11:12
 */

namespace CodeLovers\PhpStormBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as JMS;

class Component
{
    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $name;

    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $autoUpload;

    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $serverName;

    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("boolean")
     */
    private $autoUploadExternalChanges;

    /**
     * @var Collection
     *
     * @JMS\Type("ArrayCollection<CodeLovers\PhpStormBundle\Model\File>")
     * @JMS\XmlList(inline=true, entry="file")
     */
    private $files;

    /**
     * @var Collection
     *
     * @JMS\Type("ArrayCollection<CodeLovers\PhpStormBundle\Model\ServerData>")
     * @JMS\XmlList(inline=true, entry="serverData")
     */
    private $serverData;

    /**
     * @var Collection
     *
     * @JMS\Type("ArrayCollection<CodeLovers\PhpStormBundle\Model\Option>")
     * @JMS\XmlList(inline=true, entry="option")
     */
    private $options;


    /**
     * constructor
     */
    public function  __construct()
    {
        $this->files = new ArrayCollection();
        $this->serverData = new ArrayCollection();
        $this->options = new ArrayCollection();
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Component
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $files
     *
     * @return Component
     */
    public function setFiles(Collection $files)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * @param File $file
     *
     * @return Component
     */
    public function addFile(File $file)
    {
        $this->files->add($file);

        return $this;
    }

    /**
     * @return string
     */
    public function getAutoUpload()
    {
        return $this->autoUpload;
    }

    /**
     * @param string $autoUpload
     *
     * @return Component
     */
    public function setAutoUpload($autoUpload)
    {
        $this->autoUpload = $autoUpload;

        return $this;
    }

    /**
     * @return string
     */
    public function getServerName()
    {
        return $this->serverName;
    }

    /**
     * @param string $serverName
     *
     * @return Component
     */
    public function setServerName($serverName)
    {
        $this->serverName = $serverName;

        return $this;
    }

    /**
     * @return string
     */
    public function getAutoUploadExternalChanges()
    {
        return $this->autoUploadExternalChanges;
    }

    /**
     * @param string $autoUploadExternalChanges
     *
     * @return Component
     */
    public function setAutoUploadExternalChanges($autoUploadExternalChanges)
    {
        $this->autoUploadExternalChanges = $autoUploadExternalChanges;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getServerData()
    {
        return $this->serverData;
    }

    /**
     * @param Collection $serverData
     *
     * @return Component
     */
    public function setServerData(Collection $serverData)
    {
        $this->serverData = $serverData;

        return $this;
    }

    /**
     * @param ServerData $serverData
     *
     * @return Component
     */
    public function addServerData(ServerData $serverData)
    {
        $this->serverData->add($serverData);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param Collection $options
     *
     * @return Component
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @param Option $option
     *
     * @return Component
     */
    public function addOption(Option $option)
    {
        $this->options->add($option);

        return $this;
    }
} 