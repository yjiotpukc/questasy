<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\QuestStage\QuestStage;
use Game\Domain\Entity\QuestStage\QuestStageWithCondition;

class Branching extends AbstractQuestAction
{
    /** @var QuestStageWithCondition[] */
    protected array $stagesWithCondition;

    public function nextStage(GameStatus $gameStatus): QuestStage
    {
        foreach ($this->stagesWithCondition as $stageWithCondition) {
            if ($stageWithCondition->condition->test($gameStatus)) {
                return $stageWithCondition->questStage;
            }
        }

        throw new PossibleStageDoesNotExist();
    }
}
