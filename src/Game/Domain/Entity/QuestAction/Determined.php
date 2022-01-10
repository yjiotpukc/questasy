<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Game\Domain\Entity\GameStatus;

class Determined extends AbstractQuestAction
{
    protected string $questStageId;

    public function nextStage(GameStatus $gameStatus): string
    {
        return $this->questStageId;
    }
}
