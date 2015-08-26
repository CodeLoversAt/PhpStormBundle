<?php
/**
 * @package PhpStormBundle
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 26.08.15
 * @time 12:05
 */

namespace CodeLovers\PhpStormBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as JMS;

class ServerData
{
    /**
     * @var Collection
     *
     * @JMS\XmlList(inline=true, entry="paths")
     * @JMS\Type("ArrayCollection<CodeLovers\PhpStormBundle\Model\Paths>")
     */
    private $paths;

    public function __construct()
    {
        $this->paths = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * @param Collection $paths
     *
     * @return ServerData
     */
    public function setPaths(Collection $paths)
    {
        $this->paths = $paths;

        return $this;
    }

    /**
     * @param Paths $paths
     *
     * @return ServerData
     */
    public function addPaths(Paths $paths)
    {
        $this->paths->add($paths);

        return $this;
    }
}