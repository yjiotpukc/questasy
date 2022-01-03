<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

class ItemGroup
{
    protected int $id;

    public function is(ItemGroup $other): bool
    {
        return $this->id === $other->id;
    }
}
