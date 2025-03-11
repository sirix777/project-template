<?php

declare(strict_types=1);

namespace ExampleModule\Infra\Persistence\Cycle;

use Common\Infra\Persistence\Cycle\Typecast\Chronos\ChronosToDateTimeType;
use Vjik\CycleTypecast\TypecastHandler;

class ExampleTypecast extends TypecastHandler
{
    protected function getConfig(): array
    {
        return [
            'createdAt' => new ChronosToDateTimeType(),
            'updatedAt' => new ChronosToDateTimeType(),
            'deletedAt' => new ChronosToDateTimeType(),
        ];
    }
}
