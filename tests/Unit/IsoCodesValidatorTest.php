<?php

namespace Pixelpeter\IsoCodesValidation\Tests\Unit;

use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Pixelpeter\IsoCodesValidation\Tests\TestCase;

class IsoCodesValidatorTest extends TestCase
{
    /**
     * DataProvider for failing tests
     *
     * @return array
     */
    public static function invalidDataProvider()
    {
        return include_once __DIR__.'/../fixtures/invalid.php';
    }

    /**
     * DataProvider for simple rules
     *
     * @return array
     */
    public static function validDataProvider()
    {
        return include_once __DIR__.'/../fixtures/valid.php';
    }

    /**
     * DataProvider for rules with references
     *
     * @return array
     */
    public static function validDataWithReferencesProvider()
    {
        return include_once __DIR__.'/../fixtures/valid_with_references.php';
    }

    /**
     * DataProvider for arrays with dot notation
     *
     * @return array
     */
    public static function validDataWithDotNotationProvider()
    {
        return include_once __DIR__.'/../fixtures/valid_with_dot_notation.php';
    }

    /**
     * DataProvider for arrays with dot notation
     *
     * @return array
     */
    public static function invalidDataWithDotNotationProvider()
    {
        return include_once __DIR__.'/../fixtures/invalid_with_dot_notation.php';
    }

    #[DataProvider('invalidDataProvider')]
    public function test_validator_returns_correct_error_message($payload, $rules, $message)
    {
        $validator = Validator::make($payload, $rules);

        $this->assertEquals($message, $validator->errors()->first());
    }

    #[DataProvider('validDataProvider')]
    public function test_it_validates_correctly($field, $value)
    {
        $validator = Validator::make([$field => $value], [$field => $field]);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('validDataWithReferencesProvider')]
    public function test_it_validates_correctly_with_references(
        $field,
        $value,
        $referenceField = '',
        $referenceValue = ''
    ) {
        $payload = [
            $field => $value,
            $referenceField => $referenceValue,
        ];

        $rules = [
            $field => "{$field}:{$referenceField}",
        ];

        $validator = Validator::make($payload, $rules);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('validDataWithDotNotationProvider')]
    public function test_it_validates_correctly_with_dot_notation($data, $rule)
    {
        $payload = [
            'data' => $data,
        ];

        $validator = Validator::make($payload, $rule);

        $this->assertTrue($validator->passes());
        $this->assertEmpty($validator->errors()->all());
    }

    #[DataProvider('invalidDataWithDotNotationProvider')]
    public function test_validator_returns_correct_error_message_with_dot_notation($data, $rule, $errors)
    {
        $payload = [
            'data' => $data,
        ];

        $validator = Validator::make($payload, $rule);

        $this->assertTrue($validator->fails());
        $this->assertCount(2, $validator->errors()->all());
        $this->assertEquals($errors[0], $validator->errors()->first());
    }
}
