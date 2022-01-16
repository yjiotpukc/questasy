<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

use Doctrine\Common\Collections\Collection;
use LogicException;

/**
 * @property-read Walkthrough $currentWalkthrough
 * @property-read Collection<int, Walkthrough> $walkthroughs
 */
class Player
{
    protected string $id;
    protected Walkthrough $currentWalkthrough;
    /** @var Collection<int, Walkthrough> */
    protected Collection $walkthroughs;

    public function __get(string $name)
    {
        return match ($name) {
            'currentWalkthrough' => $this->currentWalkthrough,
            'walkthroughs' => $this->walkthroughs,
            default => throw new LogicException(static::class . ' does not have property ' . $name),
        };
    }

    public function __isset(string $name): bool
    {
        return in_array($name, ['currentWalkthrough', 'walkthroughs']);
    }
}
