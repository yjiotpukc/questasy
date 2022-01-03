<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\QuestStage\QuestStage;

class Determined extends AbstractQuestAction
{
    protected QuestStage $nextStage;

    public function nextStage(GameStatus $gameStatus): QuestStage
    {
        return $this->nextStage;
    }
}
