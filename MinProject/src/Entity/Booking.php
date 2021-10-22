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
    private $retrun_date_expceted;

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

    public function getRetrunDateExpceted(): ?\DateTimeInterface
    {
        return $this->retrun_date_expceted;
    }

    public function setRetrunDateExpceted(\DateTimeInterface $retrun_date_expceted): self
    {
        $this->retrun_date_expceted = $retrun_date_expceted;

        return $this;
    }
}
