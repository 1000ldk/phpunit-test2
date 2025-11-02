<?php

namespace Tests;

use App\Calculator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

final class CalculatorTest extends TestCase
{
    private Calculator $calc;

    protected function setUp(): void
    {
        $this->calc = new Calculator();
    }

    #[Test]
    public function it_adds_two_numbers(): void
    {
        $this->assertSame(3, $this->calc->add(1, 2));
    }

    #[Test]
    public function it_adds_negative_and_float(): void
    {
        $this->assertSame(0, $this->calc->add(1, -1));
        $this->assertSame(3.5, $this->calc->add(1.5, 2.0));
    }

    #[Test]
    public function it_subtracts_two_numbers(): void
    {
        $this->assertSame(1, $this->calc->subtract(3, 2));
        $this->assertSame(1.0, $this->calc->subtract(1.5, 0.5));
    }

    #[Test]
    public function it_multiplies_two_numbers(): void
    {
        $this->assertSame(6, $this->calc->multiply(2, 3));
        $this->assertSame(2.0, $this->calc->multiply(1.0, 2.0));
    }

    #[Test]
    #[TestWith([1, 2, 3])]
    #[TestWith([1.5, 2.0, 3.5])]
    #[TestWith([1, -1, 0])]
    public function it_adds_examples(int|float $a, int|float $b, int|float $expected): void
    {
        $this->assertSame($expected, $this->calc->add($a, $b));
    }

    #[Test]
    public function it_divides_two_numbers(): void
    {
        $this->assertSame(2, $this->calc->divide(6, 3));
        $this->assertSame(2.5, $this->calc->divide(5.0, 2.0));
    }

    #[Test]
    public function it_throws_on_divide_by_zero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->calc->divide(1, 0);
    }
}
