<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

class Possibility
{
    protected int $base;

    public function count(GameStatus $gameStatus): int
    {
        return $this->base;
    }
}
