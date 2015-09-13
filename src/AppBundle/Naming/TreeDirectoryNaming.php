<?php

namespace AppBundle\Naming;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class TreeDirectoryNaming implements DirectoryNamerInterface
{
    /**
     * @var integer
     */
    protected $limit;

    /**
     * @param $limit
     */
    public function __construct($limit)
    {
        $this->limit = $limit;
    }
    /**
     * @param object $object
     * @param PropertyMapping $mapping
     * @return string
     */
    public function directoryName($object, PropertyMapping $mapping)
    {
        $name = $mapping->getFileName($object);

        return substr($name, 0, $this->limit) . '/' . substr($name, $this->limit, $this->limit);
    }
}