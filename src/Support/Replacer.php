<?php

declare(strict_types=1);

namespace Pixelpeter\IsoCodesValidation\Support;

use Illuminate\Validation\Validator;

final class Replacer
{
    /**
     * @var array<int|string, mixed>
     */
    private array $data;

    /**
     * @param  array<int|string, mixed>  $parameters
     */
    public function __construct(
        private readonly string $attribute,
        private readonly array $parameters,
        private readonly Validator $validator,
        private readonly ReferenceResolver $resolver
    ) {
        $this->data = $this->validator->getData();
    }

    public function replace(string $message): string
    {
        $message = $this->replaceCountry($message);

        return $this->replaceValue($message);
    }

    private function replaceCountry(string $message): string
    {
        $referenceValue = $this->resolver->resolve($this->attribute, $this->parameters, $this->data);

        return $referenceValue ? str_replace(':country', (string) $referenceValue, $message) : $message;
    }

    private function replaceValue(string $message): string
    {
        $value = data_get($this->data, $this->attribute);

        return str_replace(':value', (string) $value, $message);
    }
}
