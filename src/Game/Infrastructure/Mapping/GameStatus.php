<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping;

use Game\Domain\Entity\Item;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class GameStatus extends EmbeddedDocumentMapping
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->int('money');
        $builder->referenceMany('inventory', Item::class);
        $builder->array('decisions');
    }
}
