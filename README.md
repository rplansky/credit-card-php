# Credit Card helpers in PHP

This is a simple package to create and validate credit card numbers.

## Installation via Composer

```json
"require": {
    "rplansky/credit-card": "dev-master"
}

```

## Usage

### Validate Numbers

This validator uses the [Luhn Algorithm](http://en.wikipedia.org/wiki/Luhn_algorithm)

```php
$validator = new Plansky\CreditCard\Validator();
$validator->isValid('57234651187928922');
// true
```

### Generate Random Numbers

#### Tottaly random

```php
$generator = new Plansky\CreditCard\Generator();
$generator->generate();
// 99119662018492824
```

#### Prefix

You can generate a random number using a brand prefix.

```php
$generator = new Plansky\CreditCard\Generator();
$generator->generate(301); // Generates a DINERS number
// 30192056094873699
```

#### Length

Some brands have different number length.

```php
$generator = new Plansky\CreditCard\Generator();
$generator->generate(347, 15); // Generates an AMEX number
// 3479966030620031
```

### Generating Lots

Using same parameters of `generate` method, except for the first parameter that
is the amount of numbers that you want to generate, you can generate a lot of
numbers at once

```php
$generator = new Plansky\CreditCard\Generator();
$generator->generateLot(10, 347, 15); // Generates 10 AMEX numbers
// array(
//   0 => '3479132843454361',
//   1 => '3479587605801416',
//   2 => '3479861510504500',
//   3 => '3479130090772634',
//   4 => '3479427298826638',
//   5 => '3479894458677616',
//   6 => '3479713475691154',
//   7 => '3479468840371814',
//   8 => '3479219690811825',
//   9 => '3479326005723791'
// )
```
