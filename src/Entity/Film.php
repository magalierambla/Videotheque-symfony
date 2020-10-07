<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;  
    
    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    // private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne peut pas etre vide.")
     */
    private $title;  
    
    /**
     * @ORM\Column(type="text", length=255)
     * @Assert\NotBlank(message="Ce champ ne peut pas etre vide.")
     */
    private $resume; 

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
    * @ORM\Column(type="datetime", nullable=true)
    */
   private $lastUpdateDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="films",cascade={"persist"})
     */
   public $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }



    public function getId(): int
    {
        return $this->id;
    }   

   

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getResume()
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

    public function setLastUpdateDate(\DateTimeInterface $lastUpdateDate): self
    {
        $this->lastUpdateDate = $lastUpdateDate;

        return $this;
    }

     /**
     * @return Collection|Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {     

       if (!$this->categories->contains($category)) {

            $this->categories[] = $category;
        }
       

        return $this;
    }
    

    public function removeCategory(Category $category): self
    {   

            if ($this->categories->contains($category)) {

                $this->categories->removeElement($category);
    
            }       
          
        

        return $this;
    }

  
   
}