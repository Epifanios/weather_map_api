<?php

namespace Tests;

use App\Jobs\DispatchWeather;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Event;

use App\Models\City;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_add_city()
    {
        $data = [
            'name'  => 'Nicosia',
        ];

        $response = $this->post('cities/create', $data);

        $this->seeInDatabase('cities', [
            'name' => $data['name'],
        ]);
    }


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
