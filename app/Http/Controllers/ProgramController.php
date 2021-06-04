<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\DataTables\ProgramDataTable;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProgramDataTable $dataTable
     * @return Application|Factory|View|Response
     */
    public function index(ProgramDataTable $dataTable)
    {
//        return view('admin.program.index');
        return $dataTable->render('admin.program.index',['title'=>'البرامج']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.program.create' , ['title'=>"انشاء مجموعة تطوعية جديدة"]);
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
        $data = $this->validate(request(),[
            'name' => 'required|unique:programs|min:5',
        ],[
            'name.required' => "نرجوا ملء الحقل",
            'name.unique' => "اسم المجموعة موجود مسبقا",
            'name.min' => "اسم المجموعة قصير جدا"
        ]);
        Program::create($data);
        session()->flash('success',"تم إضافة السجل بنجاح");
        return redirect(url('programs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $program = Program::find($id);
        return view('admin.program.edit',['program'=>$program,'title'=>"تعديل اسم المجموعة"]);
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
        $data = $this->validate(request(),[
            'name' => 'required|min:5|unique:programs,name,'.$id,
        ],[
            'name.required' => "نرجوا ملء الحقل",
            'name.unique' => "اسم المجموعة موجود مسبقا",
            'name.min' => "اسم المجموعة قصير جدا"
        ]);
        Program::where('id',$id)->update($data);
        session()->flash('success',"تم تحديث السجل بنجاح");
        return redirect(url('programs'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        Program::find($id)->delete();
        session()->flash('success',"تم حذف السجل بنجاح");
        return redirect(url('programs'));
    }
}
