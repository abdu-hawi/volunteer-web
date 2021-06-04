<?php

namespace App\Http\Controllers;

use App\Models\Initiative;
use App\Models\Program;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class iOSController extends Controller
{
    protected function login(Request $request){
        $v = Volunteer::query()->where('mobile',$request->phone)->select([
            'name', 'id'
        ])->first();
        if ($v != null) {
            Volunteer::query()->where('mobile',$request->phone)->update([
                'fcm_token' => $request->fcm_token
            ]);
            $v = Volunteer::query()->where('mobile',$request->phone)->select([
                'name', 'id'
            ])->first();
            return response(["message" => $v, "status" => 200]);
        }
        else return response(["status"=>404]);
    }

    protected function program(){
        return response(Program::query()->get());
    }

    protected function prepare($initID,$volunteerID){
        $volunteer = Volunteer::query()->where('id',$volunteerID)->select(['name as volunteerName'])->first();
        $initiative = Initiative::query()->where('id',$initID)->select(['name as nameInitiative'])->first();
        return response([$volunteer,$initiative]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function register(Request $request){
//        return response(['message'=> "".count($request->programs),'status'=>200]);
        $data = Validator::make($request->all(),[
//            'fcm_token'=>'required',
            'name' => 'required',
            'age' => 'required|numeric|min:18',
            'mobile' => 'required|numeric|min:10',
            'national_id' => 'required|numeric|min:10',
            'gender' => 'required|in:female,male',
            'programs'=>'required'
        ],[
            'name.required' => "نرجوا ملء الحقل",
            "gender.required" => "فضلا أختر الجنس",
            'age.required' => "نرجوا ملء الحقل",
            'age.min' => "لا يمكن أن يكون العمر أقل من 18 سنة",
            'mobile.required' => "نرجوا ملء الحقل",
            'mobile.min' => "لا يمكن أن يكون العمر أقل من 18 سنة",
            'mobile.numeric' => "فضلا اكتب الرقم بطريقة صحيحة",
            'national_id.required' => "نرجوا ملء الحقل",
            'national_id.min' => "لا يمكن أن يكون العمر أقل من 18 سنة",
            'national_id.numeric' => "فضلا اكتب رقم الهوية بطريقة صحيحة"
        ]);
        if ($data->fails()) return response(['message'=> $data->messages(),'status'=>401]);
        DB::beginTransaction();
        try {
            $volunteer = Volunteer::create([
                'name' => request('name'),
                'age' => request('age'),
                'mobile' => request('mobile'),
                'national_id' => request('national_id'),
                'gender' => request('gender'),
                'fcm_token' => request('fcm_token'),
            ]);
            foreach ($request->programs as $program){
                $volunteer->programs()->attach($program);
            }
            DB::commit();
            return response(['message'=> "",'status'=>200]);
        }catch (\Exception $exception){
            DB::rollBack();
            return response(['message'=> $exception->getMessage(),'status'=>402]);
        }
    }

    protected function allInitiative($id){
        return DB::table('initiative_volunteer')//->where('volunteer_id','=',$id)
            ->join("volunteers","volunteers.id","=","volunteer_id")
            ->join("initiatives","initiatives.id","=","initiative_volunteer.initiative_id")
            ->select([
                'initiative_volunteer.id',
                'initiative_id',
                'volunteer_id',
                'isAccept',
                'isFinish',
                'hours',
                'initiatives.name',
                'date_start',
                'date_end',
                'status',
                'description',
            ])
            ->where('volunteer_id','=',$id)
            ->get();
    }

    protected function openInitiative($id){
        return DB::table('initiative_volunteer')//->where('volunteer_id','=',$id)
        ->join("volunteers","volunteers.id","=","volunteer_id")
            ->join("initiatives","initiatives.id","=","initiative_volunteer.initiative_id")
            ->select([
                'initiative_volunteer.id',
                'initiative_id',
                'volunteer_id',
                'isAccept',
                'isFinish',
                'hours',
                'initiatives.name',
                'date_start',
                'date_end',
                'status',
                'description',
            ])
            ->where('volunteer_id','=',$id)
            ->where('status','=',1)
            ->get();
    }

    protected function finishInitiative($id){
        return DB::table('initiative_volunteer')
        ->join("volunteers","volunteers.id","=","volunteer_id")
            ->join("initiatives","initiatives.id","=","initiative_volunteer.initiative_id")
            ->select([
                'initiative_volunteer.id',
                'initiative_id',
                'volunteer_id',
                'isAccept',
                'isFinish',
                'hours',
                'initiatives.name',
                'date_start',
                'date_end',
                'status',
                'description',
            ])
            ->where('volunteer_id','=',$id)
            ->where('isFinish','=',true)
            ->get();
    }

    protected function agree(){
        DB::table('initiative_volunteer')
            ->where('initiative_id',\request('id'))
            ->where('volunteer_id',\request('volunteerID'))
            ->update(
            ['isAccept'=>true]
        );
    }
    protected function decline(){
        DB::table('initiative_volunteer')
            ->where('initiative_id',\request('id'))
            ->where('volunteer_id',\request('volunteerID'))
            ->update(
            ['isAccept'=>false]
        );
    }
}
