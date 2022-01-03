<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestStage;

use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\QuestAction\QuestAction;
use Game\Domain\Entity\QuestEffect\QuestEffect;

class QuestStage
{
    protected string $text;
    /** @var QuestEffect[] */
    protected array $effects;
    /** @var QuestAction[] */
    protected array $actions;

    public function receiveEffects(GameStatus $gameStatus): void
    {
        foreach ($this->effects as $effect) {
            $effect->receive($gameStatus);
        }
    }
}
