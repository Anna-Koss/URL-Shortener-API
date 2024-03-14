<?php

namespace App\Entity;

use App\Repository\ShortenedUrlRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShortenedUrlRepository::class)]
class ShortenedUrl
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 2083)]
    private readonly string $originalUrl;

    #[ORM\Column]
    private int $visitCounter = 0;

    public function __construct(string $originalUrl)
    {
        $this->id = null;
        $this->originalUrl = $originalUrl;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalUrl(): ?string
    {
        return $this->originalUrl;
    }

    public function getVisitCounter(): ?int
    {
        return $this->visitCounter;
    }

    public function setVisitCounter(?int $visitCounter): static
    {
        $this->visitCounter = $visitCounter;

        return $this;
    }
}
