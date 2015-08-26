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
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as JMS;

class Paths
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
     * @JMS\XmlList(inline=true, entry="serverdata")
     * @JMS\SerializedName("serverdata")
     * @JMS\Type("ArrayCollection<CodeLovers\PhpStormBundle\Model\ServerEntry>")
     */
    private $entries;

    /**
     * Paths constructor.
     */
    public function __construct()
    {
        $this->entries = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param Collection $entries
     *
     * @return Paths
     */
    public function setEntries(Collection $entries)
    {
        $this->entries = $entries;

        return $this;
    }

    /**
     * @param ServerEntry $entry
     *
     * @return Paths
     */
    public function addEntry(ServerEntry $entry)
    {
        $this->entries->add($entry);

        return $this;
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
     * @return Paths
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}