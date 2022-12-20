<?php

use Illuminate\Database\Seeder;
use App\Model\ClaimPaymentRequest;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 1000; $i++) {
            $model = new ClaimPaymentRequest();
            $model->parent_dealer_id = 2;
            $model->service_center_id = 1;
            $model->total_amount = mt_rand(100, 99999);
            $model->requestId = 'CRTP-' . mt_rand(10000000, 99999999);
            $model->status = 'pending';
            $model->created_at = now();
            $model->updated_at = now();
            $model->save();
        }
    }
}
