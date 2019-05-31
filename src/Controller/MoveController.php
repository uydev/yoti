<?php

namespace App\Controller;

use ApiPlatform\Core\Bridge\Elasticsearch\Metadata\Document\Factory\CachedDocumentMetadataFactory;
use App\Utility\Cleaner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\HooverCoordinates;
use App\Entity\DirtCoordinates;
use App\Entity\Game;
use App\Entity\FoundDirt;

class MoveController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function move(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $gameRepository = $this->getDoctrine()->getRepository(Game::class);
        $hooverRepository = $this->getDoctrine()->getRepository(HooverCoordinates::class);
        $dirtRepository = $this->getDoctrine()->getRepository(DirtCoordinates::class);
        $foundDirtRepository = $this->getDoctrine()->getRepository(FoundDirt::class);
        $cleaner = new Cleaner();


        $parameters = json_decode($request->get('json'));
        $game = $gameRepository->insertGame($em, $parameters->roomSize, $parameters->coords);

        foreach ($parameters->patches as $patch) {
            $dirtRepository->insertDirst($em, $patch, $game);
        }

        //CHECK IF DIRECTIONS ARE WELL FORMED
        $directions = $cleaner->checkDirections($parameters->instructions);
        if (is_null($directions)) {
            return new JsonResponse(array('success' => 0, 'msg' => "Must be North/South/East/West"));
        }

        //INITIATE HOOVER'S POSITION
        $hoover = new HooverCoordinates();
        $hoover->setX($game->getStartX());
        $hoover->setY($game->getStartY());

        $foundDirts = array();
        $foundDirtsDuplicated = array();

        //MOVE HOOVER, if it's a wall get error message
        foreach ($directions as $direction) {
            $hoover = $hooverRepository->moveHoover($em, $hoover, $game, $direction);
            if ($hoover->getX() < 0 || $hoover->getY() < 0 || $hoover->getX() > $game->getRoomSizeW() - 1 || $hoover->getY() > $game->getRoomSizeH() - 1) {
                return new JsonResponse(array('success' => 0, 'msg' => "Crashed into wall"));
            } elseif ($dirtRepository->isDirt($hoover, $game)) {
                $foundDirt = array();
                $foundDirt['x'] = $hoover->getX();
                $foundDirt['y'] = $hoover->getY();
                $foundDirtsDuplicated[] = $foundDirt;
                if (!$cleaner->isDirtExists($foundDirt, $foundDirts)) $foundDirts[] = $foundDirt;
                $foundDirtRepository->insertDirt($em, $hoover);
            }
        }
        return new JsonResponse(array('coords' => $cleaner->hooverToArray($hoover), 'patches' => count($foundDirts)));
    }
}
