<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestAction;

use Game\Domain\Entity\GameStatus;

/**
 * @property-read string $id
 * @property-read string $text
 */
interface QuestAction
{
    public function nextStage(GameStatus $gameStatus): string;

    public function canShow(GameStatus $gameStatus): bool;

    public function isAvailable(GameStatus $gameStatus): bool;
}
