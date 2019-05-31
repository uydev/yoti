<?php
namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function insertGame($em, $roomSize, $coords) {
		$game=new Game();
		$game->setStartX($coords[0]);
		$game->setStartY($coords[1]);
		$game->setRoomSizeW($roomSize[0]);
		$game->setRoomSizeH($roomSize[1]);
		$em->persist($game);
		$em->flush();
		return $game;
    }
}
