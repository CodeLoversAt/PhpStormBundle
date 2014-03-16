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
     * @var Collection
     *
     * @JMS\Type("ArrayCollection<CodeLovers\PhpStormBundle\Model\File>")
     * @JMS\XmlList(inline=true, entry="file")
     */
    private $files;


    /**
     * constructor
     */
    public function  __construct()
    {
        $this->files = new ArrayCollection();
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
} 