<?php

namespace Database\Factories;

use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Volunteer::class;
    protected $first_name = [
        'فاطمة',
        'صفية',
        'حليمة',
        'ريوف',
        'رغد',
        'أمل',
        'منى',
        'خديجة',
        'زينب',
        'أسماء',
        'عبدالله',
        'محمد',
        'يوسف',
        'خالد',
        'عبدالرحمن',
        'عبدالرحيم',
        'إسماعيل',
        'يعقوب',
        'ابراهيم',
        'عمر',
        ];
    protected $second_name = [
        'علي',
        'عثمان',
        'صفوان',
        'عبدالاله',
        'سفيان',
        'أحمد',
        'حمد',
        'عبدالوارث',
        'صابر',
        'سلمان',
        'عبدالعزيز',
        'سعود',
        'يحيى',
        'زكريا',
        'اسحاق',
        'يونس',
        'جبريل',
        'يعقوب',
        'طارق',
        'زياد',
        ];

    protected $gender = ['male','female'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=>$this->first_name[rand(0,19)].' '.$this->second_name[rand(0,19)],
            "age"=> rand(19,65),
            "mobile" => rand(0501010101,0571010101),//$this->faker->phoneNumber,
            "gender" => $this->gender[rand(0,1)],
            "national_id" => rand(1012121212,1098989898),
            "points" => rand(0,17)
        ];
    }
}
