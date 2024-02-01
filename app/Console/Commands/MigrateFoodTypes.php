<?php

namespace App\Console\Commands;

use App\Models\food_type;
use App\Models\itemType;
use Illuminate\Console\Command;

class MigrateFoodTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'food:type';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Changes item_type to food_types';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $uniqueRestaurantIds = itemType::distinct('restaurant_id')->pluck('restaurant_id');

        // Retrieve item types for each unique restaurant_id
        $uniqueRestaurantIds->map(function ($restaurantId) {
            $itemTypes = ItemType::where('restaurant_id', $restaurantId)
                ->pluck('type')
                ->toArray();

            food_type::where('restaurant_id', $restaurantId)->update(['item_type' => json_encode($itemTypes)]);
        });
        return 0;
    }
}
