<?php

namespace App\Repository;

use App\Entity\HooverCoordinates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HooverCoordinates|null find($id, $lockMode = null, $lockVersion = null)
 * @method HooverCoordinates|null findOneBy(array $criteria, array $orderBy = null)
 * @method HooverCoordinates[]    findAll()
 * @method HooverCoordinates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HooverCoordinatesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HooverCoordinates::class);
    }

    public function moveHoover($em, $hoover, $game, $direction)
    {
        $newHoover = new HooverCoordinates();
        $newHoover->setX($hoover->getX());
        $newHoover->setY($hoover->getY());
        $newHoover->setDirection($direction);
        $newHoover->setGame($game);
        switch ($direction) {
            case 'N':
                $newHoover->setY($hoover->getY() + 1);
                break;
            case 'S':
                $newHoover->setY($hoover->getY() - 1);
                break;
            case 'W':
                $newHoover->setX($hoover->getX() - 1);
                break;
            case 'E':
                $newHoover->setX($hoover->getX() + 1);
                break;
        }
        $em->persist($newHoover);
        $em->flush();
        return $newHoover;
    }
}
