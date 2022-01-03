<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

use Game\Domain\Entity\QuestAction\QuestAction;
use Game\Domain\Entity\QuestStage\QuestStage;

class WalkthroughQuest
{
    protected Quest $quest;
    protected QuestStage $stage;
    /** @var QuestStage[] */
    protected array $stageHistory;

    public function __construct(Quest $quest)
    {
        $this->quest = $quest;
        $this->stage = $quest->startingStage;
        $this->stageHistory = [$this->stage];
    }

    public function progress(QuestAction $questAction, GameStatus $gameStatus): void
    {
        $this->stage = $questAction->nextStage($gameStatus);
        $this->stageHistory[] = $this->stage;
        $this->stage->receiveEffects($gameStatus);
    }
}
