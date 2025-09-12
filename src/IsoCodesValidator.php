<?php

declare(strict_types=1);

namespace Pixelpeter\IsoCodesValidation;

use Illuminate\Validation\Validator;
use Pixelpeter\IsoCodesValidation\Support\ReferenceResolver;

final class IsoCodesValidator
{
    /**
     * @param  array<int, string>  $parameters  The list of parameters.
     */
    public function __construct(
        private string $attribute,
        private mixed $value,
        private array $parameters,
        private Validator $validator,
        private string $rule,
        private string $validatorClass,
        private readonly ReferenceResolver $resolver
    ) {}

    public function validate(): bool
    {
        $referenceValue = $this->resolver->resolve(
            $this->attribute,
            $this->parameters,
            $this->validator->getData()
        );

        $validatorClass = $this->validatorClass;

        $isValid = $referenceValue === null
            ? $validatorClass::validate($this->value)
            : $validatorClass::validate($this->value, $referenceValue);

        if (! $isValid) {
            $this->validator->addFailure($this->attribute, $this->rule, $this->parameters);
        }

        return $isValid;
    }
}
