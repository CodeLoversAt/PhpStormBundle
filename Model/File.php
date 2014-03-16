<?php
/**
 * @package atipso_dev
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 16.03.14
 * @time 11:17
 */

namespace CodeLovers\PhpStormBundle\Model;

use JMS\Serializer\Annotation as JMS;

class File
{
    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $url;

    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $dialect;

    /**
     * @param string $dialect
     * @param string $url
     */
    public function __construct($dialect, $url)
    {
        $this->dialect = $dialect;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return File
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDialect()
    {
        return $this->dialect;
    }

    /**
     * @param mixed $dialect
     *
     * @return File
     */
    public function setDialect($dialect)
    {
        $this->dialect = $dialect;

        return $this;
    }
} 