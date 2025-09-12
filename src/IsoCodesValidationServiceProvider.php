<?php

declare(strict_types=1);

namespace Pixelpeter\IsoCodesValidation;

use Illuminate\Support\ServiceProvider;
use Pixelpeter\IsoCodesValidation\Support\ReferenceResolver;
use Pixelpeter\IsoCodesValidation\Support\Registry;
use Pixelpeter\IsoCodesValidation\Support\Replacer;

final class IsoCodesValidationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(
            __DIR__.'/../lang',
            'validation'
        );

        $validatorService = $this->app->make('validator');

        foreach (Registry::ruleNames() as $rule) {
            $validatorService->extend(
                $rule,
                function ($attribute, $value, $parameters, $validator) use ($rule): bool {
                    $validatorClass = Registry::validatorClassForRule($rule);
                    $referenceResolver = new ReferenceResolver;
                    $isoCodesValdator = new IsoCodesValidator($attribute, $value, $parameters, $validator, $rule, $validatorClass, $referenceResolver);

                    return $isoCodesValdator->validate();
                },
                $this->errorMessage($rule)
            );

            $validatorService->replacer($rule, function ($message, $attribute, $_, $parameters, $validator) {
                $referenceResolver = new ReferenceResolver;
                $replacer = new Replacer($attribute, $parameters, $validator, $referenceResolver);

                return $replacer->replace($message);
            });

        }
    }

    protected function errorMessage(string $rulename): string
    {
        return $this->app->make('translator')->get('validation::validation.'.$rulename);
    }
}
