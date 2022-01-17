<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestStage;

use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\Possibility;
use LogicException;

/**
 * @property-read int $countedPossibility
 * @property-read string $questStageId
 */
class PossibleQuestStage
{
    protected string $questStageId;
    protected int $countedPossibility;
    protected Possibility $possibility;

    public function countPossibility(GameStatus $gameStatus): void
    {
        $this->countedPossibility = $this->possibility->count($gameStatus);
    }

    public function __get(string $name)
    {
        return match ($name) {
            'questStageId' => $this->questStageId,
            'countedPossibility' => $this->countedPossibility,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }

    public function __isset(string $name)
    {
        return in_array($name, ['questStageId', 'countedPossibility']);
    }
}
