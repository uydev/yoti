<?php

namespace App\Utility;

class Cleaner
{
    public function isDirtExists($foundDirt, $foundDirts)
    {
        foreach ($foundDirts as $f) {
            if ($f['x'] == $foundDirt['x'] && $f['y'] == $foundDirt['y']) return true;
        }
        return false;
    }

    public function checkDirections($directions)
    {
        $return_directions = array();
        for ($i = 0; $i < strlen($directions); $i++) {
            $direction = strtoupper($directions[$i]);
            if ($direction != 'N' && $direction != 'S' && $direction != 'E' && $direction != 'W') return null;
            $return_directions[] = $direction;
        }
        return $return_directions;
    }

    public function hooverToArray($hoover)
    {
        $array = array();
        $array['x'] = $hoover->getX();
        $array['y'] = $hoover->getY();
        return $array;
    }

}
