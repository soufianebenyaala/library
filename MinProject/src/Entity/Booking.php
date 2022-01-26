<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bookings")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="bookings")
     */
    private $livre;

    /**
     * @ORM\Column(type="date")
     */
    private $booking_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $return_date;

    /**
     * @ORM\Column(type="date")
     */
    private $expected_retrun_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BackgroundColor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approver;



    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): self
    {
        $this->livre = $livre;

        return $this;
    }

    public function getBookingDate(): ?\DateTimeInterface
    {
        return $this->booking_date;
    }

    public function setBookingDate(\DateTimeInterface $booking_date): self
    {
        $this->booking_date = $booking_date;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->return_date;
    }

    public function setReturnDate(?\DateTimeInterface $return_date): self
    {
        $this->return_date = $return_date;

        return $this;
    }

    public function getExpectedRetrunDate(): ?\DateTimeInterface
    {
        return $this->expected_retrun_date;
    }

    public function setExpectedRetrunDate(\DateTimeInterface $expected_retrun_date): self
    {
        $this->expected_retrun_date = $expected_retrun_date;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->BackgroundColor;
    }

    public function setBackgroundColor(string $BackgroundColor): self
    {
        $this->BackgroundColor = $BackgroundColor;

        return $this;
    }


    public function getApprover(): ?bool
    {
        return $this->approver;
    }

    public function setApprover(bool $approver): self
    {
        $this->approver = $approver;

        return $this;
    }
    public function getLivreTitle()
    {
        return $this->livre->getTitre();
    }
    public function getLivreId()
    {
        return $this->livre->getId();
    }


}
