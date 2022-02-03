<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use App\Containers\AppSection\Authentication\Tests\TestCase;
use App\Containers\AppSection\Authentication\Tasks\ExtractLoginCustomAttributeTask;

/**
 * Class ExtractLoginCustomAttributeTest
 *
 * @group authentication
 * @group unit
 *
 * @package App\Containers\AppSection\Authentication\Tests\Unit
 */
class ExtractLoginCustomAttributeTest extends TestCase
{
    public function testGivenValidLoginAttributeThenExtractUsername(): void
    {
        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $result = App::make(ExtractLoginCustomAttributeTask::class)->run($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }

    private function assertAttributeIsExtracted($result, $userDetails): void
    {
        self::assertIsArray($result);
        self::assertArrayHasKey('username', $result);
        self::assertArrayHasKey('loginAttribute', $result);
        self::assertSame($result['username'], $userDetails['email']);
    }

    public function testWhenNoLoginAttributeIsProvidedShouldUseEmailFieldAsDefaultFallback(): void
    {
        Config::offsetUnset('appSection-authentication.login.attributes');
        $userDetails = [
            'email' => 'Mahmoud@test.test',
            'password' => 'so-secret',
        ];

        $result = App::make(ExtractLoginCustomAttributeTask::class)->run($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }
}
