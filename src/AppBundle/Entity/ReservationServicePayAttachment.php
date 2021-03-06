<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * ReservationServicePayAttachment
 *
 * @ORM\Table(name="reservation_service_pay_attachment")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class ReservationServicePayAttachment
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
     * @var Reservation
     *
     * @ORM\ManyToOne(targetEntity="ReservationService",
     *      inversedBy="payAttachments")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     */
    private $service;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var File
     * 
     * @Vich\UploadableField(mapping="pay_attachments", filenameProperty="filename")
     * @Assert\File
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="original_filename", type="string", length=255, nullable=true)
     */
    private $originalFilename;

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
     * @param File $file
     * @return \AppBundle\Entity\ReservationServicePayAttachment
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        if (null !== $file) {
            $this->updatedAt = new \DateTime('now');

            if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
                $this->originalFilename = $file->getClientOriginalName();
            }
        }

        return $this;
    }

    /**
     * @return type
     */
    public function getFile()
    {
        return $this->file;
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
     * Set filename
     *
     * @param string $filename
     *
     * @return PayAttachment
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set originalFilename
     *
     * @param string $originalFilename
     *
     * @return PayAttachment
     */
    public function setOriginalFilename($originalFilename)
    {
        $this->originalFilename = $originalFilename;

        return $this;
    }

    /**
     * Get originalFilename
     *
     * @return string
     */
    public function getOriginalFilename()
    {
        return $this->originalFilename;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PayAttachment
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
     * @return ReservationPayAttachment
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
     * Set service
     *
     * @param \AppBundle\Entity\ReservationService $service
     *
     * @return ReservationServicePayAttachment
     */
    public function setService(\AppBundle\Entity\ReservationService $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \AppBundle\Entity\ReservationService
     */
    public function getService()
    {
        return $this->service;
    }
}
