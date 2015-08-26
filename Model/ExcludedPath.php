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

class ExcludedPath
{
    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $path;

    /**
     * @var string
     *
     * @JMS\XmlAttribute
     * @JMS\Type("string")
     */
    private $local = '';

    /**
     * @return string
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * ExcludedPath constructor.
     * @param string $path
     */
    public function __construct($path, $local = '')
    {
        $this->path = $path;
        $this->local = $local;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return ExcludedPath
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }
}