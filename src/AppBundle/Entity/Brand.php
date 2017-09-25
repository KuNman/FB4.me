<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Brand
 *
 * @ORM\Table(name="brand")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BrandRepository")
 */
class Brand
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="brand", type="string", length=255, unique=true)
     */
    private $brand;
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bike", mappedBy="brand")
     */
    private $bikes;

    public function __construct()
    {
        $this->bikes = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set brand
     *
     * @param string $brand
     * @return Brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param \AppBundle\Entity\Bike $bikes
     * @return Brand
     */
    public function addBike(\AppBundle\Entity\Bike $bikes) {
        $this->bikes[] = $bikes;
        return $this;
    }

    /**
     * Remove bikes
     *
     * @param \AppBundle\Entity\Bike $bikes
     */
    public function removeBike(\AppBundle\Entity\Bike $bikes)
    {
        $this->bikes->removeElement($bikes);
    }

    /**
     * Get bikes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBike()
    {
        return $this->bike;
    }




}

