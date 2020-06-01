<?php

use App\Customer;
use App\Package;
use App\PackageDetail;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Package::truncate();
        PackageDetail::truncate();
        Customer::truncate();

        Package::create([
            'name' => 'Outright',
            'description' => 'Outright payment.'
        ]);
        Package::create([
            'name' => 'Monthly',
            'description' => 'Monthly payment.'
        ]);

       // Package::customers()->attach($customer->id);


            PackageDetail::create([
                'package_id' => 1,
                'total_price' => 2500.00,
                'down_payment' => 0.00,
                'payment_duration' => null,
                'monthly_price' => 0.00
            ]);

        PackageDetail::create([
            'package_id' => 1,
            'total_price' => 2500.00,
            'down_payment' => 500.00,
            'payment_duration' => 24.00,
            'monthly_price' => 87
        ]);

        foreach (range(1,20) as $i)
        {
           $customer = Customer::create([
               'name' => $faker->name,
               'email' => $faker->safeEmail,
               'address' => $faker->streetAddress,
               'telephone' => $faker->phoneNumber,
               'mobile' => $faker->e164PhoneNumber,
               'created_at' => now(),
               'updated_at' => now()
           ]);
            $customer->packages()->attach(mt_rand(1,2));

        }

    }
}
