<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="tags")
     */
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects()
    {
        return $this->projects;
    }

    public function addProject(Project $project)
    {
        if ($this->projects->contains($project)) {
            return;
        }

        $this->projects[] = $project;
        $project->addTag($this);
    }

    public function removeProject(Project $project)
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            $project->removeTag($this);
        }
    }
}