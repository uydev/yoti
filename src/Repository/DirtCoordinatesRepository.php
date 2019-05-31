<?php

namespace App\Repository;

use App\Entity\DirtCoordinates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DirtCoordinates|null find($id, $lockMode = null, $lockVersion = null)
 * @method DirtCoordinates|null findOneBy(array $criteria, array $orderBy = null)
 * @method DirtCoordinates[]    findAll()
 * @method DirtCoordinates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DirtCoordinatesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DirtCoordinates::class);
    }

	
    public function isDirt($hoover, $game): ?DirtCoordinates
    {
        return $this->createQueryBuilder('d')
			->where('d.x=:x')
			->AndWhere('d.y=:y')
			->AndWhere('d.game=:game')
			->setParameters(array('x'=>$hoover->getX(),'y'=>$hoover->getY(),'game'=>$game))
			->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function insertDirst($em, $patch, $game) {
		$dirtCoordinates=new DirtCoordinates();
		$dirtCoordinates->setX($patch[0]);
		$dirtCoordinates->setY($patch[1]);
		$dirtCoordinates->setGame($game);
		$em->persist($dirtCoordinates);
		$em->flush();
		return $dirtCoordinates;
    }
    // /**
    //  * @return DirtCoordinates[] Returns an array of DirtCoordinates objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DirtCoordinates
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
