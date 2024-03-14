<?php

namespace App\Service;

class UrlShortener
{
    public function shortenUrl(string $entityId): string
    {
       $shortUrl = base_convert($entityId, 10, 36);
       return $shortUrl;
    }
}