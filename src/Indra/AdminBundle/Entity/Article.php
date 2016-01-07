<?php

namespace Indra\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * Article
 *
 * @ORM\Table(name="article_blog")
 * @ORM\Entity(repositoryClass="Indra\AdminBundle\Entity\Repository\ArticleRepository")
 * @Vich\Uploadable
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     *
     * @Vich\UploadableField(mapping="article_image_blog", fileNameProperty="imageName")
     * @Assert\File(
     * maxSize="2M",
     * maxSizeMessage = "Taille max 2Mo",
     * mimeTypes = {"image/jpeg", "image/png"},
     * mimeTypesMessage = "Uploader une image au format jpg ou png"
     * )
     *
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;


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
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }


    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = new \Datetime();
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}

