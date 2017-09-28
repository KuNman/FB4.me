<?php

namespace AppBundle\Entity;
use Gedmo\Mapping\Annotation as Gedmo;


use Doctrine\ORM\Mapping as ORM;

/**
 * Query
 *
 * @ORM\Table(name="query")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QueryRepository")
 */
class Query
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
     * @ORM\Column(name="query", type="string", length=255)
     */
    private $query;

    /**
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set query
     *
     * @param string $query
     *
     * @return Query
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}

