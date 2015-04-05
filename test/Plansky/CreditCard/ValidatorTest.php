<?php
namespace Plansky\CreditCard;

/**
* Test case for Validator class
*/
class ValidatorTest extends TestCase
{
    /**
     * @dataProvider getNumbers
     */
    public function testIsValidShouldValidatesNumberSuccessfully($number, $expected)
    {
        $this->assertEquals($expected, $number);
    }

    /**
     * Retrives some credit card numbers
     *
     * @return array
     */
    public function getNumbers()
    {
        return [
            [4189343786029529, true],
            [3314371235421856, true],
            [6374319798301353, true],
            [4795233356809085, true],
            [5622154023963004, true],
            [8478091326016016, true],
            [5677882395681093, true],
            [1939738871582291, true],
            [4851540879338546, true],
            [7630614502651988, true],
            [0365529516550305, true],
            [5079130680956042, true],
            [5082644595250395, true],
            [1808712880876570, true],
            [1189343703328455, true],
            [8548419608785345, true],
            [3452386767190945, true],
            [5790632602471008, true],
            [5674392856342972, false],
            [5478659746532453, false],
            [2543294548735347, false],
            [3653654645643634, false],
            [1111111111111111, false],
            [5674302389652843, false],
            [9374326542364373, false],
            [0173543743843642, false],
            [1538435485473433, false],
            [5272937454172928, false],
            [7032532823732326, false],
            [4358713621331562, false],
            [6381517653213173, false],
            [2463174863424434, false],
            [4397482639449327, false],
            [0493747823649832, false],
            [4315487538423465, false],
            [3271849637432432, false],
        ];
    }
}
