<?php

declare(strict_types=1);

namespace Pixelpeter\IsoCodesValidation\Support;

final class ReferenceResolver
{
    /**
     * @param  array<int|string, mixed>  $parameters
     * @param  array<int|string, mixed>  $data
     */
    public function resolve(string $attribute, array $parameters, array $data): mixed
    {
        $referenceField = $parameters[0] ?? '';

        if (strpos($referenceField, '*') !== false) {
            $referenceField = $this->resolveWildcardPath($referenceField, $attribute);
        }

        return fluent($data)->get($referenceField);
    }

    private function resolveWildcardPath(string $referenceField, string $attribute): string
    {
        preg_match_all('/\.(\d+)(?=\.|$)/', $attribute, $matches);
        $indices = $matches[1];

        foreach ($indices as $idx) {
            if (strpos($referenceField, '*') === false) {
                break;
            }
            $referenceField = (string) preg_replace('/\*/', $idx, $referenceField, 1);
        }

        return $referenceField;
    }
}
