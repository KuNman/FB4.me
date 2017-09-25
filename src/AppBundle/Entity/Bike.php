<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bike
 *
 * @ORM\Table(name="bike")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BikeRepository")
 */
class Bike
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
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=true)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="material", type="string", length=255)
     */
    private $material;

    /**
     * @var string
     *
     * @ORM\Column(name="fork", type="string", length=255, nullable=true)
     */
    private $fork;

    /**
     * @var string
     *
     * @ORM\Column(name="damper", type="string", length=255, nullable=true)
     */
    private $damper;

    /**
     * @var string
     *
     * @ORM\Column(name="wheels", type="string", length=255)
     */
    private $wheels;

    /**
     * @var float
     *
     * @ORM\Column(name="size", type="string")
     */
    private $size;

    /**
     * @var int
     *
     * @ORM\Column(name="gears", type="string")
     */
    private $gears;

    /**
     * @var string
     *
     * @ORM\Column(name="geometry", type="string", length=255)
     */
    private $geometry;

    /**
     * @var int
     *
     * @ORM\Column(name="travel_fork", type="integer", nullable=true)
     */
    private $travelFork;

    /**
     * @var int
     *
     * @ORM\Column(name="travel_damper", type="integer", nullable=true)
     */
    private $travelDamper;

    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float", nullable=true)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="derailleur", type="string", nullable=false)
     */

    private $derailleur;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Brand", inversedBy="bikes")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

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
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }


    /**
     * Set model
     *
     * @param string $model
     * @return Bike
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Set year
     *
     * @param string $year
     * @return Bike
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }


    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set material
     *
     * @param string $material
     * @return Bike
     */
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return string 
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set fork
     *
     * @param string $fork
     * @return Bike
     */
    public function setFork($fork)
    {
        $this->fork = $fork;

        return $this;
    }

    /**
     * Get fork
     *
     * @return string 
     */
    public function getFork()
    {
        return $this->fork;
    }

    /**
     * Set damper
     *
     * @param string $damper
     * @return Bike
     */
    public function setDamper($damper)
    {
        $this->damper = $damper;

        return $this;
    }

    /**
     * Get damper
     *
     * @return string 
     */
    public function getDamper()
    {
        return $this->damper;
    }

    /**
     * Set wheels
     *
     * @param string $wheels
     * @return Bike
     */
    public function setWheels($wheels)
    {
        $this->wheels = $wheels;

        return $this;
    }

    /**
     * Get wheels
     *
     * @return string 
     */
    public function getWheels()
    {
        return $this->wheels;
    }

    /**
     * Set size
     *
     * @param float $size
     * @return Bike
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return float 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set gears
     *
     * @param integer $gears
     * @return Bike
     */
    public function setGears($gears)
    {
        $this->gears = $gears;

        return $this;
    }

    /**
     * Get gears
     *
     * @return integer 
     */
    public function getGears()
    {
        return $this->gears;
    }

    /**
     * Set geometry
     *
     * @param string $geometry
     * @return Bike
     */
    public function setGeometry($geometry)
    {
        $this->geometry = $geometry;

        return $this;
    }

    /**
     * Get geometry
     *
     * @return string 
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * Set travelFork
     *
     * @param integer $travelFork
     * @return Bike
     */
    public function setTravelFork($travelFork)
    {
        $this->travelFork = $travelFork;

        return $this;
    }

    /**
     * Get travelFork
     *
     * @return integer 
     */
    public function getTravelFork()
    {
        return $this->travelFork;
    }

    /**
     * Set travelDamper
     *
     * @param integer $travelDamper
     * @return Bike
     */
    public function setTravelDamper($travelDamper)
    {
        $this->travelDamper = $travelDamper;

        return $this;
    }

    /**
     * Get travelDamper
     *
     * @return integer 
     */
    public function getTravelDamper()
    {
        return $this->travelDamper;
    }

    /**
     * Set weight
     *
     * @param float $weight
     * @return Bike
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set derailleur
     *
     * @param string $derailleur
     * @return Bike
     */
    public function setDerailleur($derailleur)
    {
        $this->derailleur = $derailleur;

        return $this;
    }



    /**
     * Get derailleur
     *
     * @return string
     */
    public function getDerailleur()
    {
        return $this->derailleur;
    }

    /**
     * Set brand
     *
     * @param \AppBundle\Entity\Brand $author
     * @return Bike
     */
    public function setBrand(\AppBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \AppBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
}
