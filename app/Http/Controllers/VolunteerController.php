<?php

namespace App\Http\Controllers;

use App\DataTables\VolunteerDataTable;
use App\Models\Volunteer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param VolunteerDataTable $dataTable
     * @return Response
     */
    public function index(VolunteerDataTable $dataTable)
    {
        return $dataTable->render('admin.volunteer.index',['title' => "المتطوعين"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.volunteer.create' , ['title'=>"اضافة متطوع"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $pro = explode(",",request('program'));
        $request->program = [];
        foreach ($pro as $p){
            array_push($request->program,$p);
        }
        $data = $this->validate($request,[
            'name' => 'required',
            'age' => 'required|numeric|min:18',
            'mobile' => 'required|numeric|min:10',
            'national_id' => 'required|numeric|min:10',
            'gender' => 'required|in:male,female',
            'program'=>'required',
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
            'national_id.numeric' => "فضلا اكتب رقم الهوية بطريقة صحيحة",
            'program.required' => 'فضلا اختر واحد من البرامج على الاقل'
        ]);
        DB::beginTransaction();
        try {
            $volunteer = Volunteer::create($data);
            foreach ($request->program as $program){
                $volunteer->programs()->attach($program);
            }
            DB::commit();
            session()->flash('success',"تم إضافة السجل بنجاح");
            return redirect(url('volunteers'));
        }catch (\Exception $exception){
            DB::rollBack();
            session()->flash('success',"لم تتم الاضافة, فضلا حاول مرة أخرى");
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $volunteer = Volunteer::find($id);
        return view('admin.volunteer.edit',['volunteer'=>$volunteer,'title'=>"تعديل متطوع"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Response|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $pro = explode(",",request('program'));
        $request->program = [];
        foreach ($pro as $p){
            array_push($request->program,$p);
        }
        $data = $this->validate(request(),
            [
                'name' => 'required',
                'age' => 'required|numeric|min:18',
                'mobile' => 'required|numeric|min:10',
                'national_id' => 'required|numeric|min:10',
                'gender' => 'required|in:male,female',
                'program'=>'required',
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
                'national_id.numeric' => "فضلا اكتب رقم الهوية بطريقة صحيحة",
                'program.required' => 'فضلا اختر واحد من البرامج على الاقل'
            ]
        );
        DB::beginTransaction();
        try {
             Volunteer::where('id',$id)->update([
                'name' => $request->name,
                'age' => $request->age,
                'mobile' => $request->mobile,
                'national_id' => $request->national_id,
                'gender' => $request->gender,
            ]);
            DB::table('program_volunteer')->where('volunteer_id',$id)->delete();
            foreach ($request->program as $program){
                DB::table('program_volunteer')->insert([
                    'volunteer_id'=>$id,
                    'program_id'=>$program,
                ]);
            }
            DB::commit();
            session()->flash('success',"تم تحديث السجل بنجاح");
            return redirect(url('volunteers'));
        }catch (\Exception $exception){
            DB::rollBack();
            session()->flash('success',"لم تتم الاضافة, فضلا حاول مرة أخرى");
            return back()->withInput();
        }
    }
}
