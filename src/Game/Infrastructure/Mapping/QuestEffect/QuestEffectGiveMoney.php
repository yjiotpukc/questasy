<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping\QuestEffect;

use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class QuestEffectGiveMoney extends EmbeddedDocumentMapping
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->int('amount');
    }
}
