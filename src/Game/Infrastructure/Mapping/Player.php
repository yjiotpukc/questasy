<?php

declare(strict_types=1);

namespace Game\Infrastructure\Mapping;

use Game\Domain\Entity\Walkthrough;
use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class Player extends DocumentMapping
{
    public function map(Document $builder): void
    {
        $builder->collection('players');
        $builder->id();
        $builder->embedMany('walkthroughs', Walkthrough::class);
        $builder->embedOne('currentWalkthrough', Walkthrough::class);
    }
}
