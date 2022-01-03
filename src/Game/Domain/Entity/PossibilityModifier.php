<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

interface PossibilityModifier
{
    public function modify(GameStatus $gameStatus, int $possibility): int;
}
