<?php
namespace Plansky\CreditCard;

/**
* Generator a random credit card number from a prefix and length. This is useful
* when you need to test some specific brand numbers that you can't find out in
* the internet easily.
*/
class Generator
{
    /**
     * Generates the random credit card number using the given prefix and
     * length. It uses default otherwise
     *
     * @param string|integer $prefix
     * @param integer        $length
     *
     * @return string
     */
    public function generate($prefix = null, $length = 16)
    {
        $number = $prefix . $this->getRand($length - strlen($prefix));

        return $number . (new LuhmCalculator())->verificationDigit($number);
    }

    /**
     * Generates the given amount of credit card numbers
     *
     * @param integer        $amount
     * @param string|integer $prefix
     * @param integer        $length
     *
     * @return [type]          [description]
     */
    public function generateLot($amount, $prefix = null, $length = 16)
    {
        $numbers = [];
        for ($index = 1; $index <= $amount; $index++) {
            $numbers[] = $this->generate($prefix, $length);
        }

        return $numbers;
    }

    /**
     * Retrieves a random number to put in the middle of card number by a given
     * length.
     *
     * Example:
     *     length = 5: Generates a number between 90000 and 99999
     *
     * @param integer $length
     *
     * @return integer
     */
    private function getRand($length)
    {
        return rand(
            '9' . str_repeat('0', $length - 1),
            str_repeat('9', $length)
        );
    }
}
