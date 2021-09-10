<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LMS\Billings\Models\Provider;

class BillingProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $billings = [
            [
                'name' => 'Paypal',
                'image' => 'https://w1.pngwing.com/pngs/138/644/png-transparent-paypal-logo-text-line-blue.png',
                'active' => false,
            ],
            [
                'name' => 'GerenciaNet',
                'image' => 'https://gerencianet.com.br/wp-content/themes/Gerencianet/assets/images/portal-da-marca/versoes-da-marca/vertical/gerencianet-vertical-colorido.png',
                'active' => true,
            ]
        ];

        foreach ($billings as $billing) {
            Provider::create($billing);
        }
    }
}
