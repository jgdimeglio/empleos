<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=20)
     */
    private $cuit;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=15)
     */
    private $phone;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=90)
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="company")
     */
    private $jobs;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=Province::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $province;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="company", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCuit(): ?string
    {
        return $this->cuit;
    }

    public function setCuit(string $cuit): self
    {
        $this->cuit = $cuit;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setCompany($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getCompany() === $this) {
                $job->setCompany(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProvince(): ?Province
    {
        return $this->province;
    }

    public function setProvince(?Province $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }
}
