<?php

namespace App\Containers\Locations\Country\UI\API\Tests\Functional;

use App\Containers\Locations\Country\Tests\ApiTestCase;

/**
 * Class CreateCountry
 *
 * @package App\Containers\Locations\Country\UI\API\Tests\Functional
 */
class CreateCountryTest extends ApiTestCase
{

    protected string $endpoint = 'post@v1/countries';

    public function testSuccessCreateCountry(): void
    {
        $data = [
            'name' => 'Kazahstan',
            'params' => [
                'currency' => 'tenge'
            ]
        ];

        $response = $this->makeCall($data);
        $response->assertStatus(201);
        $this->assertResponseContainKeyValue([
            'name' => $data['name'],
            'params' => $data['params']
        ]);

        $responseContent = $this->getResponseContentObject();
        $this->assertNotEmpty($responseContent->data);
        $this->assertDatabaseHas(config('locations-country.table.name'), ['name' => $data['name']]);
    }

    public function testNoDataCreateCountry(): void
    {
        $response = $this->makeCall([]);
        $response->assertStatus(422);
        $this->assertSame('Unprocessable Content', $response->statusText());
    }
}
