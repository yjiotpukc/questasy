<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

class Item
{
    protected string $id;
    protected string $name;
    /** @var ItemGroup[] */
    protected array $groups;

    public function is(Item $other): bool
    {
        return $this->id === $other->id;
    }

    public function isInGroup(ItemGroup $itemGroup): bool
    {
        foreach ($this->groups as $group) {
            if ($group->is($itemGroup)) {
                return true;
            }
        }

        return false;
    }
}
