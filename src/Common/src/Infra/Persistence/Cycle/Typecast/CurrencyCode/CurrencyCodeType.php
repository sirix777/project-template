<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Typecast\CurrencyCode;

use InvalidArgumentException;
use Override;
use Sirix\Money\CurrencyCode;
use Sirix\Money\Exception\SirixMoneyException;
use Vjik\CycleTypecast\TypeInterface;

use function is_numeric;
use function is_string;

class CurrencyCodeType implements TypeInterface
{
    #[Override]
    public function convertToDatabaseValue(mixed $value): int
    {
        if (! $value instanceof CurrencyCode) {
            throw new InvalidArgumentException('Value must be an instance of CurrencyCode.');
        }

        return $value->numericCode();
    }

    /**
     * @throws SirixMoneyException
     */
    #[Override]
    public function convertToPhpValue(mixed $value): CurrencyCode
    {
        if (! is_string($value) && ! is_numeric($value)) {
            throw new InvalidArgumentException('Database value must be a string or numeric.');
        }

        return CurrencyCode::fromNumericCode((int) $value);
    }
}
