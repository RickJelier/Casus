<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdProjects")
     */
    private $createdByUser;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="projects")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="projects")
     */
    private $tags;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
     * @return mixed
     */
    public function getCreatedByUser()
    {
        return $this->createdByUser;
    }

    /**
     * @param mixed $createdByUser
     */
    public function setCreatedByUser($createdByUser)
    {
        $this->createdByUser = $createdByUser;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function addUser(User $user)
    {
        if ($this->users->contains($user)) {
            return;
        }

        $this->users[] = $user;
        $user->addProject($this);
    }

    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
        $user->removeProject($this);
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    public function addTag(Tag $tag)
    {
        if ($this->tags->contains($tag)) {
            return;
        }

        $this->tags[] = $tag;
        $tag->addProject($this);
    }

    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
        $tag->removeProject($this);
    }
}