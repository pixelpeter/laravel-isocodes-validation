<?php

declare(strict_types=1);

namespace Pixelpeter\IsoCodesValidation\Tests\Unit\Support;

use PHPUnit\Framework\Attributes\DataProvider;
use Pixelpeter\IsoCodesValidation\Support\ReferenceResolver;
use Pixelpeter\IsoCodesValidation\Tests\TestCase;

final class ReferenceResolverTest extends TestCase
{
    private ReferenceResolver $resolver;

    protected function setUp(): void
    {
        parent::setUp();
        $this->resolver = new ReferenceResolver;
    }

    #[DataProvider('referenceValueProvider')]
    public function test_it_correctly_resolves_reference_value(
        string $attribute,
        array $parameters,
        array $data,
        ?string $expected
    ): void {
        $result = $this->resolver->resolve($attribute, $parameters, $data);
        $this->assertSame($expected, $result);
    }

    public static function referenceValueProvider(): array
    {
        $data = [
            'country' => 'DE',
            'user' => [
                'profile' => [
                    'country_code' => 'FR',
                ],
            ],
            'items' => [
                [
                    'id' => 1,
                    'country' => 'US',
                    'country_code' => 'DE',
                    'locations' => [
                        ['zip' => '11111'],
                        ['zip' => '22222'],
                    ],
                ],
                ['id' => 2, 'country' => 'CA'],
            ],
            'nested' => [
                [
                    'details' => [
                        ['country' => 'JP'],
                        ['country' => 'AU'],
                    ],
                ],
            ],
        ];

        return [
            // attribute, parameters, data, expected
            'simple lookup' => ['zip', ['country'], $data, 'DE'],
            'nested lookup' => ['zip', ['user.profile.country_code'], $data, 'FR'],
            'key not found' => ['zip', ['non_existent_key'], $data, null],
            'no parameters' => ['zip', [], $data, null],
            'simple wildcard' => ['items.1.zip', ['items.*.country'], $data, 'CA'],
            'another simple wildcard' => ['items.0.zip', ['items.*.country'], $data, 'US'],
            'nested wildcard' => ['nested.0.details.1.zip', ['nested.*.details.*.country'], $data, 'AU'],
            'fewer wildcards than indices' => ['items.0.locations.1.zip', ['items.*.country_code'], $data, 'DE'],
        ];
    }
}
