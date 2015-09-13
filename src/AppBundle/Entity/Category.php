<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 * @UniqueEntity("name")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     *
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var Subcategory[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Subcategory", mappedBy="category")
     */
    protected $subcategories;

    public function __construct()
    {
        $this->subcategories = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Subcategory[]|ArrayCollection
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }

    /**
     * @param Subcategory[]|ArrayCollection $subcategories
     * @return $this
     */
    public function setSubcategories($subcategories)
    {
        $this->subcategories = $subcategories;

        return $this;
    }
}