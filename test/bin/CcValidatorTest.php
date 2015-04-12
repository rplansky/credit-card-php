<?php
namespace Command;

/**
* Test case for ccvalidator command
*/
class CcValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $commandPath;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->commandPath = __DIR__.'/../../bin/ccvalidator';
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->commandPath);
    }

    public function testCommandShouldValidateUniqueValidCreditCard()
    {
        $this->assertEquals(
            ['4072592516178960 | valid'],
            $this->exec(['4072592516178960'])
        );
    }

    public function testCommandShouldValidateUniqueInvalidCreditCard()
    {
        $this->assertEquals(
            ['4072592516178965 | invalid'],
            $this->exec(['4072592516178965'])
        );
    }

    public function testCommandShouldValidateMultipleNumbersAtOnce()
    {
        $numbers = [
            '7042360861483694',
            '6668152906742750',
            '9464790787926399',
        ];

        $expectedOutput = [
            '7042360861483694 | valid',
            '6668152906742750 | invalid',
            '9464790787926399 | valid',
        ];

        $this->assertEquals($expectedOutput, $this->exec($numbers));
    }

    /**
     * Executes the ccvalidator command with the given numbers
     *
     * @param integer[]
     *
     * @return string[] Command output
     */
    private function exec(array $numbers)
    {
        exec(
            sprintf('%s %s', $this->commandPath, implode($numbers, ' ')),
            $output
        );

        return $output;
    }
}
