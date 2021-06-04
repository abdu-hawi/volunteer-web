<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Volunteer;
use Illuminate\Database\Seeder;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Volunteer::factory()->count(50)->create();
        foreach (Volunteer::all() as $volunteer) {
            $programs = Program::inRandomOrder()->take(rand(1, 5))->pluck('id');
            foreach ($programs as $program){
                $volunteer->programs()->attach($program);
            }
        }
    }

}
