<?php

declare(strict_types=1);

namespace Game\Domain\Exception;

use Exception;

class AvailableQuestNotFoundException extends Exception
{
    protected $message = 'Quest not found';
}
