<?php

namespace App\Repository;

use App\Entity\ShortenedUrl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShortenedUrl>
 *
 * @method ShortenedUrl|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShortenedUrl|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShortenedUrl[]    findAll()
 * @method ShortenedUrl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShortenedUrlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShortenedUrl::class);
    }

    public function findOneById(int $entityId): ?ShortenedUrl
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id = :val')
            ->setParameter('val', $entityId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByUrl(string $originalUrl): ?ShortenedUrl
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.originalUrl = :val')
            ->setParameter('val', $originalUrl)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function saveNewUrl(string $originalUrl): int
    {
        $entity = new ShortenedUrl($originalUrl);
        $this->saveEntity($entity);
        return $entity->getId();
    }

    public function incrementCounter(ShortenedUrl $entity):void
    {
        $visitCounter = $entity->getVisitCounter() + 1;
        $entity->setVisitCounter($visitCounter);
        $this->saveEntity($entity);
    }

    private function saveEntity(ShortenedUrl $entity): void
    {

        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
