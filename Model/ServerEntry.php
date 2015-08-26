<?php
/**
 * @package PhpStormBundle
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 26.08.15
 * @time 12:14
 */

namespace CodeLovers\PhpStormBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\Collection;

class ServerEntry
{
    /**
     * @var Collection
     *
     * @JMS\XmlList(entry="mapping")
     * @JMS\Type("ArrayCollection<CodeLovers\PhpStormBundle\Model\Mapping>")
     */
    private $mappings;

    /**
     * @var Collection
     *
     * @JMS\XmlList(entry="excludedPath")
     * @JMS\Type("ArrayCollection<CodeLovers\PhpStormBundle\Model\ExcludedPath>")
     */
    private $excludedPaths;

    public function __construct()
    {
        $this->mappings = new ArrayCollection();
        $this->excludedPaths = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getMappings()
    {
        return $this->mappings;
    }

    /**
     * @param Collection $mappings
     *
     * @return ServerEntry
     */
    public function setMappings(Collection $mappings)
    {
        $this->mappings = $mappings;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getExcludedPaths()
    {
        return $this->excludedPaths;
    }

    /**
     * @param Collection $excludedPaths
     *
     * @return ServerEntry
     */
    public function setExcludedPaths(Collection $excludedPaths)
    {
        $this->excludedPaths = $excludedPaths;

        return $this;
    }

    /**
     * @param Mapping $mapping
     *
     * @return ServerEntry
     */
    public function addMapping(Mapping $mapping)
    {
        $this->mappings->add($mapping);

        return $this;
    }

    /**
     * @param ExcludedPath $excludedPath
     *
     * @return ServerEntry
     */
    public function addExcludedPath(ExcludedPath $excludedPath)
    {
        $this->excludedPaths->add($excludedPath);

        return $this;
    }

    /**
     * @param integer $idx
     * @param ExcludedPath $path
     *
     * @return ServerEntry
     */
    public function addExcludedPathAtIndex($idx, ExcludedPath $path)
    {
        $this->excludedPaths->set($idx, $path);

        return $this;
    }
}