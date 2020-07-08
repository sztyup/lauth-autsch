<?php

declare(strict_types=1);

namespace Sztyup\LAuth\Authsch\Entities;

use Doctrine\ORM\Mapping as ORM;
use Sztyup\LAuth\Entities\Account;

/**
 * @ORM\Entity
 * @ORM\Table(name="lauth_authsch")
 */
class AuthschAccount extends Account
{
    public const BME_STATUS_NEWBIE      = 4;
    public const BME_STATUS_VIK_ACTIVE  = 3;
    public const BME_STATUS_VIK_PASSIVE = 2;
    public const BME_STATUS_BME         = 1;
    public const BME_STATUS_NONE        = 0;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $schacc;

    /**
     * @var integer|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $bmeId;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $bmeStatus;

    /**
     * @var integer|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $virId;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $virUid;

    /**
     * @var string|null
     *
     * @ORM\Column(type="phonenumber", nullable=true)
     */
    protected $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $neptun;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): AuthschAccount
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): AuthschAccount
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSchacc(): ?string
    {
        return $this->schacc;
    }

    public function setSchacc(string $schacc): AuthschAccount
    {
        $this->schacc = $schacc;

        return $this;
    }

    public function getBmeId(): ?int
    {
        return $this->bmeId;
    }

    public function setBmeId(int $bmeId): AuthschAccount
    {
        $this->bmeId = $bmeId;

        return $this;
    }

    public function getBmeStatus(): int
    {
        return $this->bmeStatus;
    }

    public function setBmeStatus(int $bmeStatus): AuthschAccount
    {
        $this->bmeStatus = $bmeStatus;

        return $this;
    }

    public function getVirId(): ?int
    {
        return $this->virId;
    }

    public function setVirId(?int $virId): AuthschAccount
    {
        $this->virId = $virId;

        return $this;
    }

    public function getVirUid(): ?string
    {
        return $this->virUid;
    }

    public function setVirUid(?string $virUid): AuthschAccount
    {
        $this->virUid = $virUid;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): AuthschAccount
    {
        $this->phone = $phone;

        return $this;
    }

    public function getNeptun(): ?string
    {
        return $this->neptun;
    }

    public function setNeptun(?string $neptun): AuthschAccount
    {
        $this->neptun = $neptun;

        return $this;
    }
}