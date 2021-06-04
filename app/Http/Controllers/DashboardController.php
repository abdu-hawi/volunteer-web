<?php

namespace App\Http\Controllers;

use App\Models\Initiative;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected function index(){
        $initiatives = Initiative::with('volunteers')->orderByDesc('initiatives.id')->limit(7)->get();
        $cnt_volunteer = [];
        $initiatives_name = [];
        $isAccept = [];
        $male = [];
        $female = [];
        foreach ($initiatives as $initiative){
            array_push($cnt_volunteer,$initiative->volunteers->count());
            array_push($initiatives_name,$initiative->name);
            $accept = 0;
            $gender_male = 0;
            $gender_female = 0;
            foreach ($initiative->volunteers as $volunteer){
                if ($volunteer->pivot->isAccept){
                    $accept ++;
                    $volunteer->gender == "male" ? $gender_male ++ : $gender_female ++;
                }

            }
            array_push($isAccept,$accept);
            array_push($male,$gender_male);
            array_push($female,$gender_female);
        }

        return view('admin.dashboard',[
            'initiative'=>Initiative::query()->count(),
            'initiativeVolunteer'=>DB::table('initiative_volunteer')->count(),
            'avg'=>DB::table('initiative_volunteer')->average('volunteer_id'),
            'cnt_volunteer'=>$cnt_volunteer,
            'initiatives_name'=>$initiatives_name,
            'isAccept' => $isAccept,
            'male' => $male,
            'female' => $female,
        ]);
    }
}
