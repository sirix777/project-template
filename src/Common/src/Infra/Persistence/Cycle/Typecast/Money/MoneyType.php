<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Typecast\Money;

use Brick\Money\Money;
use InvalidArgumentException;
use Override;
use Sirix\Money\CurrencyCode;
use Sirix\Money\Exception\SirixMoneyException;
use Sirix\Money\SirixMoney;
use Vjik\CycleTypecast\TypeInterface;

use function is_numeric;
use function is_string;

class MoneyType implements TypeInterface
{
    /**
     * @throws SirixMoneyException
     */
    #[Override]
    public function convertToDatabaseValue(mixed $value): string
    {
        if (! $value instanceof Money) {
            throw new InvalidArgumentException('Value must be an instance of Money.');
        }

        $money = SirixMoney::of($value->getAmount(), CurrencyCode::ErnCrypto);

        return SirixMoney::getMinorAmount($money);
    }

    /**
     * @throws SirixMoneyException
     */
    #[Override]
    public function convertToPhpValue(mixed $value): Money
    {
        if (! is_string($value) && ! is_numeric($value)) {
            throw new InvalidArgumentException('Database value must be a string or numeric.');
        }

        // ERN is scaled to 24 digits. It's good to use it as a default currency scale.
        return SirixMoney::ofMinor($value, CurrencyCode::ErnCrypto);
    }
}
