<?php

declare(strict_types=1);

namespace CommonTest\Infra\Persistence\Cycle\Typecast\Money;

use Common\Infra\Persistence\Cycle\Typecast\Money\MoneyType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Sirix\Money\Exception\SirixMoneyException;
use Sirix\Money\SirixMoney;

class MoneyTypeTest extends TestCase
{
    private MoneyType $moneyType;

    protected function setUp(): void
    {
        $this->moneyType = new MoneyType();
    }

    /**
     * @throws SirixMoneyException
     */
    public function testConvertToDatabaseValueWithValidMoneyInstance(): void
    {
        $money = SirixMoney::of('123.45', 'USD');
        $result = $this->moneyType->convertToDatabaseValue($money);

        $expected = '123450000000000000000';
        $this->assertSame($expected, $result);
    }

    /**
     * @throws SirixMoneyException
     */
    public function testConvertToDatabaseValueWithRoundedAmount(): void
    {
        $money = SirixMoney::of('123.456789', 'USD');
        $result = $this->moneyType->convertToDatabaseValue($money);

        $expected = '123460000000000000000';
        $this->assertSame($expected, $result);
    }

    public function testConvertToDatabaseValueThrowsForInvalidType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value must be an instance of Money.');

        $this->moneyType->convertToDatabaseValue('invalid_value');
    }

    /**
     * @throws SirixMoneyException
     */
    public function testConvertToDatabaseValueHandlesZeroAmount(): void
    {
        $money = SirixMoney::of('0', 'USD');
        $result = $this->moneyType->convertToDatabaseValue($money);

        $expected = '0';
        $this->assertSame($expected, $result);
    }

    /**
     * @throws SirixMoneyException
     */
    public function testConvertToDatabaseValueHandlesLargePrecision(): void
    {
        $money = SirixMoney::of('1.123456789123456789', 'ETH');
        $result = $this->moneyType->convertToDatabaseValue($money);

        $expected = '1123456789123456789';
        $this->assertSame($expected, $result);
    }
}
