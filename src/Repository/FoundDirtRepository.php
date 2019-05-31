<?php

namespace App\Repository;

use App\Entity\FoundDirt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FoundDirt|null find($id, $lockMode = null, $lockVersion = null)
 * @method FoundDirt|null findOneBy(array $criteria, array $orderBy = null)
 * @method FoundDirt[]    findAll()
 * @method FoundDirt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoundDirtRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FoundDirt::class);
    }

    public function insertDirt($em, $hoover)
    {
        $foundDirt = new FoundDirt();
        $foundDirt->setX($hoover->getX());
        $foundDirt->setY($hoover->getY());
        $foundDirt->setHooverCoordinates($hoover);
        $em->persist($foundDirt);
        $em->flush();
        return $foundDirt;
    }
}
