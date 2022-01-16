<?php

declare(strict_types=1);

namespace Game\Domain\Entity\QuestStage;

use Doctrine\Common\Collections\Collection;
use Game\Domain\Entity\GameStatus;
use Game\Domain\Entity\QuestEffect\QuestEffect;
use LogicException;

/**
 * @property-read string $id
 * @property-read string $text
 * @property-read string[] $actions
 */
class QuestStage
{
    protected string $id;
    protected string $text;
    /** @var Collection<int, QuestEffect> */
    protected Collection $effects;
    /** @var string[] */
    protected array $actions;

    public function receiveEffects(GameStatus $gameStatus): void
    {
        foreach ($this->effects as $effect) {
            $effect->receive($gameStatus);
        }
    }

    public function __get(string $name)
    {
        return match ($name) {
            'id' => $this->id,
            'text' => $this->text,
            'actions' => $this->actions,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }

    public function __isset(string $name): bool
    {
        return in_array($name, ['id', 'text', 'actions']);
    }
}
