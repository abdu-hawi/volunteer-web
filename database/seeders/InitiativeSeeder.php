<?php

namespace Database\Seeders;

use App\Models\Initiative;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class InitiativeSeeder extends Seeder{

    public $arr = [
        [
            'ترجمة كتاب استراتيجية الشطرنج',
            'مدخل إلى الذكاء الاصطناعي',
            "الذكاء الاصطناعي وأهميته في التعليم",
            "ورشة عمل الذكاء الاصطناعي والطب",
            "الذكاء الاصطناعي والتعلم العميق وتعلم الالة"
        ],[
            "مقدمة في الشبكات",
            "الشبكات السلكية واللاسلكية",
            "Network+ دورة",
            "ورشة عمل CCNA",
            "ورشة عمل CCNP",
        ],[
            "أمن وحماية الشبكات",
            "كيف تحمي نفسك من الاختراق",
            "شرح لأهم ثغرات تطبيقات الويب",
            "حماية تطبيقات الجوال والهندسة العكسية",
            "مواقع التواصل وطرق جمع المعلومات"
        ],[
            "مدخل الى علم قواعد البيانات",
            "قواعد البيانات العلائقية واللاعلائقية وأهم الفروقات بينها",
            "الأفكار تحليلها وطرق تحويلها إلى نموذج برمجي",
            "الخرائط الانسيابية وأهمية كتابة مراجع التطبيقات",
            "الـ API وأهميتها في تطبيقات الويب"
        ],[
            "طرق تشفير تطبيقات الاندرويد ومنع الهندسة العكسية للتطبيقات",
            "دورة مكثفة عن MVVM ماهو وأهميته والفرق بينه وبين MVC",
            "دمج أكثر من لغة برمجية في تطبيق واحد",
            "تصميم الواجهات وتعدد الشاشات",
            "الفرق بين لغة جافا اندرويد وكوتلين, نقاط القوة والضعف لكل لغة"
        ],[
            "مكتبة spriteKit",
            "مدخل الى لغة سويفت",
            "شرح عميق للـ storyboard و xib ونقاط القوة والضعف",
            "بناء المكتبات الخاصة وطرق دمجها بالتطبيقات وتحديثها",
            "القيود أهميتها وطرق عملها"
        ],[
            "ماهو التعلم العميق",
            "حلول التعلم العميق للآلة وريادة الذكاء الاصطناعي",
            "خوارزميات التعلم العميق",
            "أهم مكتبات بايثون للتعلم العميق",
            "العلوم التطبيقية والتعلم العميق"
        ],[
            "ورشة عمل لبناء مشروع تحليل بيانات",
            "أسس تحليل البيانات",
            "تحليل البيانات النوعية",
            "تحليل البيانات الكمية وتفسيرها",
            "علم البيانات والهدف منه"
        ],[
            "تعلم الالة ماهو؟ وأهميته؟",
            "فن تعلم الالة",
            "تعلم الالة والذكاء الاصطناعي",
            "خوارزميات تعلم الالة",
            "تعلم الالة والتعلم العميق"
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker){
        for ($i=1;$i<30;$i++){
            $dateStart = $faker->dateTimeBetween('-9 days','+3 days');
            $dateStart = $dateStart->format('Y-m-d');
            $dateEnd = $faker->dateTimeBetween('+9 days','+60 days');
            $dateEnd = $dateEnd->format('Y-m-d');
            $status = 0;
            if ($dateStart > Carbon::now()){
                $status = 1;
            }elseif ($dateStart < Carbon::now()){
                $status = 0;
            }elseif ($dateEnd > Carbon::now()){
                $status = 2;
            }

            $program = rand(1,9);
            $name = $this->arr[$program-1][rand(0,4)];

            $initiative = Initiative::create([
                "name" => $name,
                "date_start" => $dateStart,
                "date_end" => $dateEnd,
                'status' => "".$status,
                "program_id" => $program,
                "description" => $name,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);

            $programs = Program::inRandomOrder()->where('id',$program)
                ->with('volunteers')->get();
            foreach ($programs[0]->volunteers as $volunteer){
                $isAccept = rand(0,1);
                $isFinish = 0;
                if ($isAccept){
                    switch ($status){
                        case 1:
                        case 0:
                            $isFinish = rand(0,1);
                            break;
                        case 2:
                            $isFinish = 1;
                    }
                }
                $hours = 0;
                if ($isFinish){
                    $hours = rand(1,85);
                }
                DB::table('initiative_volunteer')->insert([
                    "initiative_id" => $initiative->id,
                    "volunteer_id" => $volunteer->id,
                    "isAccept" => $isAccept,
                    "isFinish" => $isFinish,
                    'hours' => "".$hours,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
            }
        }

    }
}
