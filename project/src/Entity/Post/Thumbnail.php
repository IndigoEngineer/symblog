<?php

namespace App\Entity\Post;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File;
use App\Repository\Post\ThumbnailRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ThumbnailRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Thumbnail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'thumbnail', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $Post = null;

    #[Vich\UploadableField(mapping: 'post_thumbnails', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;


    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt;

    #[ORM\PreUpdate]
    public  function  preUpdate()
    {
        $this->updatedAt = new DateTimeImmutable();
    }
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?Post
    {
        return $this->Post;
    }

    public function setPost(Post $Post): self
    {
        $this->Post = $Post;

        return $this;
    }
}
