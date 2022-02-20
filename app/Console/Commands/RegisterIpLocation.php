<?php

namespace App\Console\Commands;

use App\models\Visitor;
use App\Traits\PointOnMapTrait;
use App\Traits\SavePlaceTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RegisterIpLocation extends Command
{
    public $cont;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:ip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record the location of an ip';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->cont = 0;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $allvisitors = Visitor::orderBy('updated_at','DESC')->whereNull('country')->whereNull('city')->limit(10)->get();

        if(!empty($allvisitors)) {
            foreach ($allvisitors as $visitor) {

                $location = PointOnMapTrait::apiResponse($visitor->number_ip);
                if (!empty($location)) {
                    $visitor->country = $location['country'];
                    $visitor->city = $location['city'];
                    $visitor->latitude = $location['lat'];
                    $visitor->longitude = $location['lon'];
                    $visitor->zip = $location['zip'];

                    if ($visitor->update()){
                        $this->cont++;
                        SavePlaceTrait::saveCity($location);
                    }
                }
            };
            $this->info('Registrando ip total: ' . $allvisitors->count());
            Log::info('Registrando ip total: ' . $allvisitors->count());
        }
        return $allvisitors->count();
    }
}
