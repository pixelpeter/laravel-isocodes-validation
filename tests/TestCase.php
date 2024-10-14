<?php

namespace Pixelpeter\IsoCodesValidation\Tests;

use Illuminate\Foundation\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
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
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';

        $app->register(IsoCodesValidationServiceProvider::class);

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
