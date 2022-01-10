<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Doctrine\Common\Collections\Collection;
use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\QuestStage\QuestStageWithCondition;
use Game\Domain\Exception\PossibleStageDoesNotExist;

class Branching extends AbstractQuestAction
{
    /** @var Collection<int, QuestStageWithCondition> */
    protected Collection $stagesWithCondition;

    public function nextStage(GameStatus $gameStatus): string
    {
        foreach ($this->stagesWithCondition as $stageWithCondition) {
            if ($stageWithCondition->condition->test($gameStatus)) {
                return $stageWithCondition->questStageId;
            }
        }

        throw new PossibleStageDoesNotExist();
    }
}
