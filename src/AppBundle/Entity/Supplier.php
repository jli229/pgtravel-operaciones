<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Supplier
 *
 * @ORM\Table(name="supplier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SupplierRepository")
 */
class Supplier
{
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
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_address", type="text", nullable=true)
     */
    private $postalAddress;

    /**
     * @var \Misd\PhoneNumberBundle\Doctrine\DBAL\Types\PhoneNumberType
     *
     * @ORM\Column(name="fixed_phone", type="phone_number", nullable=true)
     */
    private $fixedPhone;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SupplierEmployee", mappedBy="supplier", cascade={"persist", "remove"})
     */
    private $employees;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Contract", mappedBy="supplier")
     */
    private $contracts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contracts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getName();
    }

    /**
     * Get id
     *
     * @return int
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
     * @return Supplier
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Supplier
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
     * @return Supplier
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
     * Add contract
     *
     * @param \AppBundle\Entity\Contract $contract
     *
     * @return Supplier
     */
    public function addContract(\AppBundle\Entity\Contract $contract)
    {
        $this->contracts[] = $contract;

        return $this;
    }

    /**
     * Remove contract
     *
     * @param \AppBundle\Entity\Contract $contract
     */
    public function removeContract(\AppBundle\Entity\Contract $contract)
    {
        $this->contracts->removeElement($contract);
    }

    /**
     * Get contracts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContracts()
    {
        return $this->contracts;
    }

    /**
     * Set postalAddress
     *
     * @param string $postalAddress
     *
     * @return Supplier
     */
    public function setPostalAddress($postalAddress)
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * Set fixedPhone
     *
     * @param phone_number $fixedPhone
     *
     * @return Supplier
     */
    public function setFixedPhone($fixedPhone)
    {
        $this->fixedPhone = $fixedPhone;

        return $this;
    }

    /**
     * Get fixedPhone
     *
     * @return phone_number
     */
    public function getFixedPhone()
    {
        return $this->fixedPhone;
    }

    /**
     * Add employee
     *
     * @param \AppBundle\Entity\SupplierEmployee $employee
     *
     * @return Supplier
     */
    public function addEmployee(\AppBundle\Entity\SupplierEmployee $employee)
    {
        $this->employees[] = $employee;

        $employee->setSupplier($this);
        
        return $this;
    }

    /**
     * Remove employee
     *
     * @param \AppBundle\Entity\SupplierEmployee $employee
     */
    public function removeEmployee(\AppBundle\Entity\SupplierEmployee $employee)
    {
        $this->employees->removeElement($employee);
    }

    /**
     * Get employees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployees()
    {
        return $this->employees;
    }
}