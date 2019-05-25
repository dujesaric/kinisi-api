<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Embeddable\Name;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 */
class User
{
    private $id;

    private $email;

    private $enabled;

    private $firstName;

    private $lastName;

    private $gender;

    private $roles = [];

    private $plainPassword;

    private $emailVerificationToken;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $verifiedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastLogin;

    private $passwordResetToken;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getEmailVerificationToken(): ?string
    {
        return $this->emailVerificationToken;
    }

    public function setEmailVerificationToken(?string $emailVerificationToken): self
    {
        $this->emailVerificationToken = $emailVerificationToken;

        return $this;
    }

    public function getVerifiedAt(): ?\DateTimeInterface
    {
        return $this->verifiedAt;
    }

    public function setVerifiedAt(?\DateTimeInterface $verifiedAt): self
    {
        $this->verifiedAt = $verifiedAt;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getPasswordResetToken(): ?string
    {
        return $this->passwordResetToken;
    }

    public function setPasswordResetToken(?string $passwordResetToken): self
    {
        $this->passwordResetToken = $passwordResetToken;

        return $this;
    }
}
