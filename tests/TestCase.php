<?php

namespace Pixelpeter\IsoCodesValidation\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Pixelpeter\IsoCodesValidation\IsoCodesValidationServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app)
    {
        return [
            IsoCodesValidationServiceProvider::class,
        ];
    }
}
