<?php

namespace App\Jobs;

use App\Models\City;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Throwable;

class DispatchWeather extends Job
{
    //public $timeout = 120;
    //public $tries = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public array $data)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('forecast')->insert($this->data);
    }
}
