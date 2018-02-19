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
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
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
        $this->roles = new ArrayCollection();
        $this->groups = new ArrayCollection();
        $this->projects = new ArrayCollection();
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
     * @return Collection|Group[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    public function addGroup(Group $group)
    {
        if ($this->groups->contains($group)) {
            return;
        }

        $this->groups[] = $group;
        $group->addUser($this);
    }

    public function removeGroup(Group $group)
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