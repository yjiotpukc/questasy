<?php

declare(strict_types=1);

namespace Game\Domain\Entity;

use Doctrine\Common\Collections\Collection;

class GameStatus
{
    protected int $money;
    /** @var Collection<int, Item> */
    protected Collection $inventory;
    /** @var string[] */
    protected array $decisions;

    public function addMoney(int $amount): void
    {
        $this->money += $amount;
    }

    public function giveItem(Item $item): void
    {
        $this->inventory[] = $item;
    }

    public function takeOneItem(Item $item): void
    {
        foreach ($this->inventory as $index => $inventoryItem) {
            if ($inventoryItem->is($item)) {
                unset($this->inventory[$index]);

                return;
            }
        }
    }

    public function takeAllItems(Item $item): void
    {
        foreach ($this->inventory as $index => $inventoryItem) {
            if ($inventoryItem->is($item)) {
                unset($this->inventory[$index]);
            }
        }
    }

    public function takeAllItemsFromGroup(ItemGroup $itemGroup): void
    {
        foreach ($this->inventory as $index => $inventoryItem) {
            if ($inventoryItem->isInGroup($itemGroup)) {
                unset($this->inventory[$index]);
            }
        }
    }

    public function rememberDecision(string $decision, string $value): void
    {
        $this->decisions[$decision] = $value;
    }

    public function forgetDecision(string $decision): void
    {
        unset($this->decisions[$decision]);
    }
}
