<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity
 */
class Reservation
{
    const STATE_OFFER = 'offer';
    const STATE_RESERVATION = 'reservation';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=true, onDelete="set null")
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="direct_client_full_name", type="string", length=255, nullable=true)
     */
    private $directClientFullName;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_line", type="string", length=20, nullable=true)
     * @Assert\Regex("/|sms|email|phone-call/")
     */
    private $notificationLine;

    /**
     * @var ClientContact
     *
     * @ORM\ManyToOne(targetEntity="ClientContact")
     * @ORM\JoinColumn(nullable=true, onDelete="set null")
     */
    private $notificationContact;
    
    /**
     * @var string
     *
     * @ORM\Column(name="state", length=11)
     * @Assert\Regex("/offer|reservation/")
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="traveler_names", type="text", nullable=true)
     */
    private $travelerNames;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ReservationService", mappedBy="reservation", cascade={"persist", "remove"})
     */
    private $services;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ReservationAdministrativeCharge", mappedBy="reservation", cascade={"persist", "remove"})
     */
    private $administrativeCharges;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->state = 'offer';
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->administrativeAharges = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getClientType()
    {
        return null === $this->getId() ? 'registered' : (null !== $this->client ? 'registered' : 'direct');
    }

    public function setClientType($value)
    {
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Reservation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Reservation
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set travelerNames
     *
     * @param string $travelerNames
     *
     * @return Reservation
     */
    public function setTravelerNames($travelerNames)
    {
        $this->travelerNames = $travelerNames;

        return $this;
    }

    /**
     * Get travelerNames
     *
     * @return string
     */
    public function getTravelerNames()
    {
        return $this->travelerNames;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Reservation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Reservation
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set directClientFullName
     *
     * @param string $directClientFullName
     *
     * @return Reservation
     */
    public function setDirectClientFullName($directClientFullName)
    {
        $this->directClientFullName = $directClientFullName;

        return $this;
    }

    /**
     * Get directClientFullName
     *
     * @return string
     */
    public function getDirectClientFullName()
    {
        return $this->directClientFullName;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Reservation
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set notificationLine
     *
     * @param string $notificationLine
     *
     * @return Reservation
     */
    public function setNotificationLine($notificationLine)
    {
        $this->notificationLine = $notificationLine;

        return $this;
    }

    /**
     * Get notificationLine
     *
     * @return string
     */
    public function getNotificationLine()
    {
        return $this->notificationLine;
    }

    /**
     * Set notificationContact
     *
     * @param \AppBundle\Entity\ClientContact $notificationContact
     *
     * @return Reservation
     */
    public function setNotificationContact(\AppBundle\Entity\ClientContact $notificationContact = null)
    {
        $this->notificationContact = $notificationContact;

        return $this;
    }

    /**
     * Get notificationContact
     *
     * @return \AppBundle\Entity\ClientContact
     */
    public function getNotificationContact()
    {
        return $this->notificationContact;
    }

    /**
     * Add service
     *
     * @param \AppBundle\Entity\ReservationService $service
     *
     * @return Reservation
     */
    public function addService(\AppBundle\Entity\ReservationService $service)
    {
        $this->services[] = $service;

        $service->setReservation($this);

        return $this;
    }

    /**
     * Remove service
     *
     * @param \AppBundle\Entity\ReservationService $service
     */
    public function removeService(\AppBundle\Entity\ReservationService $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Add administrativeCharge
     *
     * @param \AppBundle\Entity\ReservationAdministrativeCharge $administrativeCharge
     *
     * @return Reservation
     */
    public function addAdministrativeCharge(\AppBundle\Entity\ReservationAdministrativeCharge $administrativeCharge)
    {
        $this->administrativeCharges[] = $administrativeCharge;

        $administrativeCharge->setReservation($this);

        return $this;
    }

    /**
     * Remove administrativeCharge
     *
     * @param \AppBundle\Entity\ReservationAdministrativeCharge $administrativeCharge
     */
    public function removeAdministrativeCharge(\AppBundle\Entity\ReservationAdministrativeCharge $administrativeCharge)
    {
        $this->administrativeCharges->removeElement($administrativeCharge);
    }

    /**
     * Get administrativeCharges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdministrativeCharges()
    {
        return $this->administrativeCharges;
    }
}
