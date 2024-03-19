<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\City;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_average_temp_city()
    {
        $city = City::find(1);

        $parameters = [
            'city_id' => $city->id,
        ];

        $this->get("average", $parameters);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'avg'
            ]
        );
        $response = $this->response->getContent();
        $this->assertJson($response);
    }
}
