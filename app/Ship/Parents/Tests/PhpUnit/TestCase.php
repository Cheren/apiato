<?php

namespace App\Ship\Parents\Tests\PhpUnit;

use Faker\Generator;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel as ApiatoConsoleKernel;
use Apiato\Core\Abstracts\Tests\PhpUnit\TestCase as AbstractTestCase;

/***
 * Class TestCase
 *
 * @package App\Ship\Parents\Tests\PhpUnit
 */
abstract class TestCase extends AbstractTestCase
{
    /**
     * Default data.
     *
     * @var array
     */
    private array $data = [];

    /**
     * Setup the test environment, before each test.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Reset the test environment, after each test.
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $this->baseUrl = env('API_FULL_URL'); // this reads the value from `phpunit.xml` during testing

        // override the default subDomain of the base URL when subDomain property is declared inside a test
        $this->overrideSubDomain();

        $app = require __DIR__ . '/../../../../../bootstrap/app.php';

        $app->make(ApiatoConsoleKernel::class)->bootstrap();

        // create instance of faker and make it available in all tests
        $this->faker = $app->make(Generator::class);

        return $app;
    }

    /**
     * With data.
     *
     * @param array $data
     *
     * @return array
     */
    public function withData(array $data): array
    {
        return array_replace_recursive($this->data, $data);
    }
}
