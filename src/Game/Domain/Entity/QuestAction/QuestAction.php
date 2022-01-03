<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\QuestStage\QuestStage;

interface QuestAction
{
    public function nextStage(GameStatus $gameStatus): QuestStage;

    public function canShow(GameStatus $gameStatus): bool;

    public function isAvailable(GameStatus $gameStatus): bool;
}
