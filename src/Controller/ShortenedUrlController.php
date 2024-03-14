<?php

namespace App\Controller;

use App\Repository\ShortenedUrlRepository;
use App\Service\UrlShortener;
use App\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShortenedUrlController extends AbstractController
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly ShortenedUrlRepository $shortenedUrlRepository,
        private readonly UrlShortener $urlShortener,
    ) {
    }

    #[Route('/api/shorten-url', name: 'app_shorten_url')]
    public function index(Request $request): JsonResponse
    {
        $originalUrl = $request->request->get('originalUrl');

        if (!$this->validator->validate($originalUrl)) {
            return new JsonResponse(['error' => 'Url is not valid'], 400);
        }

        if ($entity = $this->shortenedUrlRepository->findOneByUrl($originalUrl)) {
            $entityId = $entity->getId();
        } else {
            $entityId = $this->shortenedUrlRepository->saveNewUrl($originalUrl);
        }

        $shortUrl = $this->urlShortener->shortenUrl($entityId);

        $baseUrl = $request->getSchemeAndHttpHost();

        return $this->json([
            'shortenedUrl' => $baseUrl . '/s/' . $shortUrl
        ]);
    }

    #[Route('/s/{path}', name: 'app_redirect')]
    public function redirectByShortUrl(string $path): Response
    {
        // base_convert returns '0' if path is invalid. Our entity ids start from 1400
        $entityId = base_convert($path, 36, 10);

        if ($entity = $this->shortenedUrlRepository->findOneById($entityId)) {
            $originalUrl = $entity->getOriginalUrl();
            $this->shortenedUrlRepository->incrementCounter($entity);
        } else {
            return new JsonResponse(['error' => 'Url is not found'], 404);
        }

        return new RedirectResponse($originalUrl);
    }
}
