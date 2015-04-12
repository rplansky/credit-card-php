<?php
namespace Plansky\CreditCard;

/**
* Test case for Generator class
*/
class GeneratorTest extends TestCase
{
    public function testSingleShouldGenerateAValidRandomNumber()
    {
        $number = $this->generator->single();

        $this->assertLength(16, $number);
        $this->assertTrue($this->validator->isValid($number));
    }

    public function testSingleShouldGenerateAValidNumberWithGivenPrefix()
    {
        $this->assertPrefix('123', $this->generator->single(123));
    }

    public function testSingleShouldGenerateAValidNumberWithCustomLength()
    {
        $this->assertLength(10, $this->generator->single(null, 10));
    }

    public function testLotShouldGenerateAnArrayOfValidNumbers()
    {
        $numbers = $this->generator->lot(10);

        foreach ($numbers as $number) {
            $this->assertLength(16, $number);
            $this->assertTrue($this->validator->isValid($number));
        }
    }

    public function testLotShouldGenerateAnArrayOfNumbersWithGivenPrefix()
    {
        $numbers = $this->generator->lot(10, 123);

        foreach ($numbers as $number) {
            $this->assertPrefix('123', $number);
        }
    }

    public function testLotShouldGenerateAnArrayOfValidNumbersWithCustomLength()
    {
        $numbers = $this->generator->lot(10, null, 10);

        foreach ($numbers as $number) {
            $this->assertLength(10, $number);
        }
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The 'length' parameter should be greater than 'prefix' string length
     */
    public function testSingleWithInsuficientLengthShouldThrowsException()
    {
        $this->generator->single('1234', 4);
    }
}
