<?php
/**
 * @package atipso_dev
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 16.03.14
 * @time 11:09
 */

namespace CodeLovers\PhpStormBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("project")
 */
class Project
{
    /**
     * @var int
     *
     * @JMS\XmlAttribute
     * @JMS\Type("integer")
     */
    private $version = 4;

    /**
     * constructor
     */
    public function  __construct()
    {
        $this->components = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     *
     * @return Project
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @var Collection
     *
     * @JMS\Type("ArrayCollection<CodeLovers\PhpStormBundle\Model\Component>")
     * @JMS\XmlList(inline=true, entry="component")
     */
    private $components;

    /**
     * @return Collection
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @param Collection $components
     *
     * @return Project
     */
    public function setComponents(Collection $components)
    {
        $this->components = $components;

        return $this;
    }

    /**
     *
     * @return Collection
     */
    public function getTemplateDataLanguageMappings()
    {
        return $this->components->filter(function (Component $c) {
            return 'TemplateDataLanguageMappings' === $c->getName();
        });
    }

    /**
     * @return Collection
     */
    public function getPublishConfigData()
    {
        return $this->components->filter(function (Component $c) {
            return 'PublishConfigData' === $c->getName();
        });
    }
} 