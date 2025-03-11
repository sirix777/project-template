<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Typecast\Currency;

use Brick\Money\Currency;
use InvalidArgumentException;
use Override;
use Sirix\Money\CurrencyCode;
use Sirix\Money\CurrencyRegistry;
use Sirix\Money\Exception\SirixMoneyException;
use Vjik\CycleTypecast\TypeInterface;

use function is_numeric;
use function is_string;

class CurrencyType implements TypeInterface
{
    #[Override]
    public function convertToDatabaseValue(mixed $value): int
    {
        if (! $value instanceof Currency) {
            throw new InvalidArgumentException('Value must be an instance of Money.');
        }

        return $value->getNumericCode();
    }

    /**
     * @throws SirixMoneyException
     */
    #[Override]
    public function convertToPhpValue(mixed $value): Currency
    {
        if (! is_string($value) && ! is_numeric($value)) {
            throw new InvalidArgumentException('Database value must be a string or numeric.');
        }

        return CurrencyRegistry::getInstance()->get(CurrencyCode::fromNumericCode((int) $value)->value);
    }
}
