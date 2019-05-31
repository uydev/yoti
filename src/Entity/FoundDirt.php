<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Game;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FoundDirtRepository")
 */
class FoundDirt
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
    private $x;

    /**
     * @ORM\Column(type="integer")
     */
    private $y;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HooverCoordinates", inversedBy="hooverCoordinatesId")
     */
    private $hooverCoordinates;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getX(): ?int
    {
        return $this->x;
    }

    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getHooverCoordinates(): ?HooverCoordinates
    {
        return $this->hooverCoordinates;
    }

    public function setHooverCoordinates(?HooverCoordinates $hooverCoordinates): self
    {
        $this->hooverCoordinates = $hooverCoordinates;

        return $this;
    }
}
