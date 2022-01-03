<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestStage;

use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\Possibility;
use LogicException;

/**
 * @property-read int $countedPossibility
 */
class PossibleQuestStage extends QuestStage
{
    protected Possibility $possibility;
    protected int $countedPossibility;

    public function countPossibility(GameStatus $gameStatus): void
    {
        $this->countedPossibility = $this->possibility->count($gameStatus);
    }

    public function __get(string $name)
    {
        return match ($name) {
            'countedPossibility' => $this->countedPossibility,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }
}
