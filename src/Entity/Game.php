<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $startX;

    /**
     * @ORM\Column(type="integer")
     */
    private $startY;

    /**
     * @ORM\Column(type="integer")
     */
    private $roomSizeW;

    /**
     * @ORM\Column(type="integer")
     */
    private $roomSizeH;

	
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartX(): ?int
    {
        return $this->startX;
    }

    public function setStartX(int $startX): self
    {
        $this->startX = $startX;

        return $this;
    }

    public function getStartY(): ?int
    {
        return $this->startY;
    }

    public function setStartY(int $startY): self
    {
        $this->startY = $startY;

        return $this;
    }

    public function getRoomSizeW(): ?int
    {
        return $this->roomSizeW;
    }

    public function setRoomSizeW(int $roomSizeW): self
    {
        $this->roomSizeW = $roomSizeW;

        return $this;
    }

    public function getRoomSizeH(): ?int
    {
        return $this->roomSizeH;
    }

    public function setRoomSizeH(int $roomSizeH): self
    {
        $this->roomSizeH = $roomSizeH;

        return $this;
    }
}
