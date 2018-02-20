<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Destination", mappedBy="user")
     */
    private $destinations;

    /**
     * @ORM\OneToMany(targetEntity="Note", mappedBy="user")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="createdByUser")
     */
    private $createdProjects;

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity="ClassGroup", inversedBy="users")
     */
    private $groups;

    /**
     * @ORM\ManyToMany(targetEntity="Project", inversedBy="users")
     */
    private $projects;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->createdProjects = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->groups = new ArrayCollection();
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
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return Collection|Destination[]
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    public function addDestination(Destination $destination)
    {
        if ($this->destinations->contains($destination)) {
            return;
        }

        $this->destinations[] = $destination;
        $destination->setUser($this);
    }

    public function removeDestination(Destination $destination)
    {
        $this->destinations->removeElement($destination);
        $destination->setUser(null);
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes()
    {
        return $this->notes;
    }

    public function addNote(Note $note)
    {
        if ($this->notes->contains($note)) {
            return;
        }

        $this->notes[] = $note;
        $note->setUser($this);
    }

    public function removeNote(Note $note)
    {
        $this->notes->removeElement($note);
        $note->setUser(null);
    }

    /**
     * @return Collection|Project[]
     */
    public function getCreatedProjects()
    {
        return $this->createdProjects;
    }

    public function addCreatedProject(Project $project)
    {
        if ($this->createdProjects->contains($project)) {
            return;
        }

        $this->createdProjects[] = $project;
        $project->setCreatedByUser($this);
    }

    public function removeCreatedProject(Project $project)
    {
        $this->createdProjects->removeElement($project);
        $project->setCreatedByUser(null);
    }

    /**
     * @return Collection|Role[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function addRole(Role $role)
    {
        if ($this->roles->contains($role)) {
            return;
        }

        $this->roles[] = $role;
        $role->addUser($this);
    }

    public function removeRole(Role $role)
    {
        $this->roles->removeElement($role);
        $role->removeUser($this);
    }

    /**
     * @return Collection|ClassGroup[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    public function addGroup(ClassGroup $group)
    {
        if ($this->groups->contains($group)) {
            return;
        }

        $this->groups[] = $group;
        $group->addUser($this);
    }

    public function removeGroup(ClassGroup $group)
    {
        $this->groups->removeElement($group);
        $group->removeUser($this);
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
        $project->addUser($this);
    }

    public function removeProject(Project $project)
    {
        $this->projects->removeElement($project);
        $project->removeUser($this);
    }
}