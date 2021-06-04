<?php

namespace App\Http\Controllers;

use App\DataTables\InitiativeDataTable;
use App\Models\Initiative;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

class InitiativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param InitiativeDataTable $dataTable
     * @return Response
     */
    public function index(InitiativeDataTable $dataTable)
    {
        return $dataTable->render('admin.initiative.index',['title' => "الفرص التطوعية"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.initiative.create' , ['title'=>"اضافة فرصة تطوعية"]);
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
        $data = $this->validate($request,[
            'name' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'program_id' => 'required|numeric',
            'description' => 'required'
        ],[
            'description.required' => "نرجوا ملء الحقل",
            'name.required' => "نرجوا ملء الحقل",
            "date_start.required" => "فضلا ادخل تاريخ بداية الفرصة",
            'date_end.required' => "فضلا ادخل تاريخ نهاية الفرصة",
            "date_start.date" => "فضلا اكتب التاريخ بطريقة صحيحة",
            'date_end.date' => "فضلا اكتب التاريخ بطريقة صحيحة",
            'program_id.required' => "نرجو اختيار احد البرامج",
        ]);
        $isSave = false;
        $initiative_id = 0;
        DB::beginTransaction();
        try {
            $initiative = Initiative::create($data);
            $volunteers = DB::table('program_volunteer')->where('program_id',$initiative->program_id)
                ->select(['volunteer_id as id'])->get();
            foreach ($volunteers as $volunteer){
                DB::table('initiative_volunteer')->insert([
                    'initiative_id'=>$initiative->id,
                    'volunteer_id'=>$volunteer->id,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ]);
            }
            DB::commit();
            $initiative_id = $initiative->id;
            $isSave = true;
        }catch (\Exception $exception){
            DB::rollBack();
//            dd($exception);
            $isSave = false;
        }

        if ($isSave){
            $this->sendNotification(request('name'),
                request('date_start'),
                request('date_end'),
                request('description'),
                $initiative_id);
            session()->flash('success',"تم إضافة السجل بنجاح");
            return redirect(url('initiatives'));
        }else{
            return back()->withInput();
        }
    }

    private function sendNotification($name,$start,$end,$desc,$id){
        $token = "c_gTVCgbzU2WkIpfTq4btO:APA91bHkgzFsqS09qRN1kD1D0czcF6FCk2iuB4ZLW7vbGcCoTjofzwqp4_J8zG28nsAYcJjwkhP7dQw3VJAhkecgQDI-5dkoR5Erzhr5RvPUdpWkk3JvVRpejFwU8SPVdCPoDgWXKTt1";
        $apiKeys = "AAAA-iNFEFM:APA91bFq9ibNy4HEDafxhmzJ7feZv0hT2xmPWCmaBTopd5fmmXI2ids32niwWDQZjwdxIx_zRLUDZ2PF8bNzc4wd4q9E4gQV4rSeXxzb5kMS-BAXGnEMcIEgjwhtsg4WNS_sG4vNXtkU";
        $msg = array
        (
            'title' => $name,
            'body'  => $desc,
            'receiver' => '',
            'name' => $name,
            'desc' => $desc,
            'start' => $start,
            'end' => $end,
            'id' => $id,
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array(
            'to'            => $token,
            'notification'  => $msg
        );

        $headers = array
        (
            'Authorization: key=' . $apiKeys,
            'Content-Type: application/json'
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );

        curl_close( $ch );
    }

    protected function resendNotification(Request $request){
        if (!$request->ajax()){
            return \response(["d"=>request('id')]);
        }
        $intiv = Initiative::query()->where('id',request('id'))->first();
        $token = "c_gTVCgbzU2WkIpfTq4btO:APA91bHkgzFsqS09qRN1kD1D0czcF6FCk2iuB4ZLW7vbGcCoTjofzwqp4_J8zG28nsAYcJjwkhP7dQw3VJAhkecgQDI-5dkoR5Erzhr5RvPUdpWkk3JvVRpejFwU8SPVdCPoDgWXKTt1";
        $apiKeys = "AAAA-iNFEFM:APA91bFq9ibNy4HEDafxhmzJ7feZv0hT2xmPWCmaBTopd5fmmXI2ids32niwWDQZjwdxIx_zRLUDZ2PF8bNzc4wd4q9E4gQV4rSeXxzb5kMS-BAXGnEMcIEgjwhtsg4WNS_sG4vNXtkU";
        $msg = array
        (
            'title' => $intiv->name,
            'body'  => $intiv->desc,
            'receiver' => '',
            'name' => $intiv->name,
            'desc' => $intiv->desc,
            'start' => $intiv->start,
            'end' => $intiv->end,
            'id' => $intiv->id,
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array(
            'to'            => $token,
            'notification'  => $msg
        );

        $headers = array
        (
            'Authorization: key=' . $apiKeys,
            'Content-Type: application/json'
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );

        curl_close( $ch );
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        $get = DB::table('initiatives')->where('id','=',$id)->first();
        $h = Carbon::now()->diffInHours($get->created_at);
        DB::table('initiative_volunteer')->where('initiative_id','=',$get->id)
            ->where('isAccept',"=",1)
            ->update([
                'isFinish'=> 1,
                'hours' => $h
            ]);
        return redirect('initiatives');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $initiative = Initiative::find($id);
        return view('admin.initiative.edit',['initiative'=>$initiative,'title'=>"تعديل فرصة تطوعية"]);
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
        $data = $this->validate($request,[
            'name' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'program_id' => 'required|numeric',
            'description' => 'required'
        ],[
            'description' => "نرجوا ملء الحقل",
            'name.required' => "نرجوا ملء الحقل",
            "date_start.required" => "فضلا ادخل تاريخ بداية الفرصة",
            'date_end.required' => "فضلا ادخل تاريخ نهاية الفرصة",
            "date_start.date" => "فضلا اكتب التاريخ بطريقة صحيحة",
            'date_end.date' => "فضلا اكتب التاريخ بطريقة صحيحة",
            'program_id.required' => "نرجو اختيار احد البرامج",
        ]);
        Initiative::where('id',$id)->update($data);

        session()->flash('success',"تم تحديث السجل بنجاح");
        return redirect(url('initiatives'));
    }

    /**
     * @param $id
     * @return Application|ResponseFactory|Response
     * @throws Html2PdfException
     */
    public function qrCode($id){
        $initiative = Initiative::query()->where('id',$id)->select('name')->first();
        $content = view('admin.initiative.qr_code',['id'=>$id,'name'=>$initiative->name])->render();
        $html2pdf_path = base_path() . '\vendor\spipu\html2pdf\src\html2pdf.php';
        File::requireOnce($html2pdf_path);

        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en');
            $html2pdf->setDefaultFont('aealarabiya');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->WriteHTML($content);
            $html2pdf->Output('example.pdf');

            ob_flush();
            ob_end_clean();
        }
        catch (\Exception $e) {
            echo $e;
            exit;
        }
        $pdf= $html2pdf->Output('', 'S');
        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Length', strlen($pdf))
            ->header('Content-Disposition', 'inline','filename="example.pdf"');
    }

    public function chart(){
        $init =  Initiative::query()->orderByDesc('id')->with(['volunteers'])->first();
        $isAccept = 0;
        $volunteers = count($init->volunteers);
        foreach ($init->volunteers as $volunteer){
            if ($volunteer->pivot->isAccept){
                $isAccept ++;
            }
        }
        return \response(['isAccept'=>$isAccept, 'cnt'=>$volunteers, 'name'=>$init->name]);
    }
}
