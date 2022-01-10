<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping;

use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;

class Possibility extends EmbeddedDocumentMapping
{
    public function map(EmbeddedDocument $builder): void
    {
        $builder->int('base');
    }
}
