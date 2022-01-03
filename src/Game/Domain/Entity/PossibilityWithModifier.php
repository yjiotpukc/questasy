<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

class PossibilityWithModifier extends Possibility
{
    /** @var PossibilityModifier[] */
    protected array $modifiers;

    public function count(GameStatus $gameStatus): int
    {
        $possibility = $this->base;

        foreach ($this->modifiers as $modifier) {
            $possibility = $modifier->modify($gameStatus, $possibility);
        }

        return $possibility;
    }
}
