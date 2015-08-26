<?php
/**
 * @package PhpStormBundle
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 26.08.15
 * @time 13:17
 */

namespace CodeLovers\PhpStormBundle\Model;

use JMS\Serializer\Annotation as JMS;

class Mapping
{
    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $deploy;

    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $local;

    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $web;

    /**
     * @return string
     */
    public function getDeploy()
    {
        return $this->deploy;
    }

    /**
     * @param string $deploy
     *
     * @return Mapping
     */
    public function setDeploy($deploy)
    {
        $this->deploy = $deploy;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @param string $local
     *
     * @return Mapping
     */
    public function setLocal($local)
    {
        $this->local = $local;
        return $this;
    }

    /**
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * @param string $web
     *
     * @return Mapping
     */
    public function setWeb($web)
    {
        $this->web = $web;
        return $this;
    }
}