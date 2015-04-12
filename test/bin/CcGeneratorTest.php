<?php
namespace Command;

use Plansky\CreditCard\Validator;

/**
* Test case for ccvalidator command
*/
class CcGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $commandPath;

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
        $this->commandPath = __DIR__.'/../../bin/ccgenerator';
        $this->validator = new Validator();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->commandPath);
        unset($this->validator);
    }

    public function testCommandShouldGenerateARandomValidNumber()
    {
        $this->assertTrue($this->validator->isValid($this->exec()[0]));
    }

    public function testCommandShouldGenerateARandomValidNumberWithPrefix()
    {
        $number = $this->exec(null, '34')[0];

        $this->assertTrue($this->validator->isValid($number));
        $this->assertStringStartsWith('34', $number);
    }

    public function testCommandShouldGenerateARandomValidNumberWithCustomLength()
    {
        $number = $this->exec(null, null, 10)[0];

        $this->assertTrue($this->validator->isValid($number));
        $this->assertEquals(10, strlen($number));
    }

    public function testCommandShouldGenerateALotOfValidNumbers()
    {
        $numbers = $this->exec(10);

        foreach ($numbers as $number) {
            $this->assertTrue($this->validator->isValid($number));
        }

        $this->assertEquals(10, count($numbers));
    }

    public function testCommandShouldGenerateALotOfValidNumbersWithCustomSeparator()
    {
        $numbers = $this->exec(3, null, null, ',');
        $this->assertEquals(1, count($numbers));

        $numbers = explode(',', $numbers[0]);
        $this->assertEquals(3, count($numbers));

        foreach ($numbers as $number) {
            $this->assertTrue($this->validator->isValid($number));
        }
    }

    /**
     * Executes the ccgenerator command with the given parameters
     *
     * @param integer $amount
     * @param integer $prefix
     * @param integer $length
     * @param string  $separator
     *
     * @return string[] Command output
     */
    private function exec(
        $amount = null,
        $prefix = null,
        $length = null,
        $separator = null
    ) {
        $command = $this->commandPath;

        if (false === is_null($amount)) {
            $command .= ' --amount='.$amount;
        }

        if (false === is_null($prefix)) {
            $command .= ' --prefix='.$prefix;
        }

        if (false === is_null($length)) {
            $command .= ' --length='.$length;
        }

        if (false === is_null($separator)) {
            $command .= ' --separator='.$separator;
        }

        exec($command, $output);

        return $output;
    }
}
