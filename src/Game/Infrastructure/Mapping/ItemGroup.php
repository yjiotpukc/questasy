<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping;

use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class ItemGroup extends DocumentMapping
{
    public function map(Document $builder): void
    {
        $builder->collection('item_groups');
        $builder->id();
    }
}
