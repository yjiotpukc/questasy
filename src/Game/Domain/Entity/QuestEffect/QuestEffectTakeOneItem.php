<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestEffect;

use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\Item;

class QuestEffectTakeOneItem implements QuestEffect
{
    protected Item $item;

    public function receive(GameStatus $gameStatus): void
    {
        $gameStatus->takeOneItem($this->item);
    }
}
