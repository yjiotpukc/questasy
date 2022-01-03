<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestEffect;

use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\ItemGroup;

class QuestEffectTakeAllItemsFromGroup implements QuestEffect
{
    protected ItemGroup $itemGroup;

    public function receive(GameStatus $gameStatus): void
    {
        $gameStatus->takeAllItemsFromGroup($this->itemGroup);
    }
}
