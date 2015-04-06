<?php
namespace Plansky\CreditCard;

/**
* Base test case for credit card tests
*/
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Generator
     */
    protected $generator;

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->generator = new Generator();
        $this->validator = new Validator();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->generator);
        unset($this->validator);
    }

    /**
     * Checks length of the given string
     *
     * @param integer $length
     * @param string  $number
     */
    protected function assertLength($length, $number)
    {
        $this->assertEquals($length, strlen($number));
    }

    /**
     * Checks prefix of the given credit card number
     *
     * @param integer $prefix
     * @param string  $number
     */
    protected function assertPrefix($prefix, $number)
    {
        $this->assertStringStartsWith($prefix, $number);
    }

    /**
     * Checks if the given number is valid using Luhn Algorithm
     *
     * @param  integer $number
     */
    protected function assertCreditCard($number)
    {
        $lastDigit   = substr($number, -1);
        $numberArray = array_reverse(str_split($number));

        $sum = 0;
        for ($index = 0; $index < count($numberArray); $index++) {
            $digit = (int)$numberArray[$index];
            $result = $digit * 2;
            $result = ($result >= 10) ? $result - 9 : $result;
            $sum += ($index % 2 == 0) ? $result : $digit;
        }

        return $lastDigit == (10 - ($sum % 10 ?: 10));
    }
}
