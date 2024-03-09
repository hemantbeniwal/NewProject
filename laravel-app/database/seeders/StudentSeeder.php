<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $fekar = Faker::create();
        
        $age = rand(3, 100);
        for($i =1; $i<=10; $i++){
            $data = [
                "name" => $fekar->name,
                "email" => $fekar->email,
                "age" => $age,
                "class" => $fekar->numberBetween(5, 12),
                "phone" => $fekar->numberBetween(111111, 999999),
                "dob" => $fekar->date(),
                "gender" => "m",
                
            ];
            Student::create($data);  
        }
 
    }
}
