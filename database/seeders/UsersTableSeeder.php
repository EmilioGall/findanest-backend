<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // dd(strtotime('10 September 2000'));

        $newService = new User();

        $newService->name = 'Nome';
        $newService->surname = 'Cognome';
        $newService->date_of_birth = Carbon::create('2000', '10', '10');
        $newService->email = 'nomecognome@gmail.com';
        $newService->password = Hash::make('12345678');

        $newService->save();
    }
}
