<?php
namespace Plansky\CreditCard;

/**
* Validates credit card numbers using the Luhm algorithm. This validator does
* not validates BIN and specific brand or bank alrogithms.
*/
class Validator
{
    /**
     * Validates the given number using Luhm algorithm
     *
     * @param  string|integer $number
     *
     * @return boolean
     */
    public function isValid($number)
    {
        $lastDigit = substr($number, -1);
        $number    = substr($number, 0, -1);

        return (new LuhnCalculator())->verificationDigit($number) == $lastDigit;
    }
}
