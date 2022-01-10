<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping;

use Game\Domain\Entity\ItemGroup;
use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Item extends DocumentMapping
{
    public function map(Document $builder): void
    {
        $builder->collection('items');
        $builder->id();
        $builder->string('name');
        $builder->referenceMany('groups', ItemGroup::class);
    }
}
