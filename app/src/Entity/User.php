<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone_no;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_access_id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $partner_email;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhoneNo(): ?string
    {
        return $this->phone_no;
    }

    public function setPhoneNo(?string $phone_no): self
    {
        $this->phone_no = $phone_no;

        return $this;
    }

    public function getUserAccessId(): ?int
    {
        return $this->user_access_id;
    }

    public function setUserAccessId(int $user_access_id): self
    {
        $this->user_access_id = $user_access_id;

        return $this;
    }

    public function getPartnerEmail(): ?int
    {
        return $this->partner_email;
    }

    public function setPartnerEmail(?string $partner_email): self
    {
        $this->partner_email = $partner_email;

        return $this;
    }
}
