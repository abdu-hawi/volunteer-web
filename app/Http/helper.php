<?php

use App\Http\Controllers\UploadController;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

if(!function_exists('setting')){
    function setting(){
        return Setting::orderBy('id','desc')->first();
    }
}

if(!function_exists('lang')){
    function lang(){
        if(session()->has('lang')){
            return session('lang');
        } else{
            session()->put('lang',setting()->main_lang);
            return session('lang');
        }
    }
}

if(!function_exists('a_dir')){
    function a_dir()
    {
        if(session()->has('lang')){
            if( session('lang') === 'ar' ){
                return 'rtl';
            } else{
                return 'ltr';
            }
        } else{
            if( setting()->main_lang === 'ar' ){
                return 'rtl';
            } else{
                return 'ltr';
            }
        }
    }
}

if(!function_exists('angle')){
    function angle()
    {
        if( lang() == 'ar' ){
            return 'right';
        } else{
            return 'left';
        }
    }
}

if(!function_exists('datatableLang')){
    function datatableLang(){
        return [
            "sProcessing"=> "جاري التحميل ...",
            "sLengthMenu"=> "عرض _MENU_ السجلات",
            "sZeroRecords"=> "لا يوجد نتائج",
            "sEmptyTable"=> "لا توجد بيانات في هذا الجدول",
            "sInfo"=> "عرض السجلات من _START_ إلى _END_ من مجموع _TOTAL_ سجلات",
            "sInfoEmpty"=> "عرض السجلات من 0 الى 0 من مجموع السجلات 0 سجلات",
            "sInfoFiltered"=> "(تصفية من اجمالي _MAX_ السجلات)",
            "sInfoPostFix"=> "",
            "sSearch"=> "بحث:",
            "sUrl"=> "",
            "sInfoThousands"=> ",",
            "sLoadingRecords"=> "تحميل ...",
            "oPaginate"=> [
                "sFirst"=> "الأولى",
                "sLast"=> "الأخيرة",
                "sNext"=> "التالي",
                "sPrevious"=> "السابق"
            ],
            "oAria"=> [
                "sSortAscending"=> ": فرز الأعمدة بترتيب تصاعدي",
                "sSortDescending"=> ": فرز الأعمدة بترتيب تنازلي"
            ]
        ];
    }
}

if(!function_exists('active_menu')){
    function active_menu($link){
        if (preg_match('/'.$link.'/i',Request::segment(1))){
            return ['active' , 'menu-open' , 'display: block;'];
        }else{
            return ['','',''];
        }
    }
}

if(!function_exists('validate_image')){
    function validate_image($ext = null){
        if ($ext === null) return 'file|image|mimes:jpeg,png,jpg,bmp,gif|max:5120';
        else return 'image|mime:'.$ext;
    }
}

if(!function_exists('upload_file')){
    function upload_file(){
        return new UploadController();
    }
}
