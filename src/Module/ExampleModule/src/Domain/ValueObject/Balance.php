<?php

declare(strict_types=1);

namespace ExampleModule\Domain\ValueObject;

use Brick\Money\Money;
use Sirix\Money\CurrencyCode;
use Sirix\Money\Exception\SirixMoneyException;
use Sirix\Money\SirixMoney;

readonly class Balance
{
    private Money $balance;

    /**
     * @throws SirixMoneyException
     */
    public function __construct(string $value, private CurrencyCode $currency)
    {
        $this->balance = SirixMoney::ofMinor($value, $currency);
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }

    public function getCurrencyCode(): CurrencyCode
    {
        return $this->currency;
    }
}
