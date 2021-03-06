<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class SettingController extends Controller
{
    protected function setting(){
        return view('admin.settings',['title'=>'الاعدادات']);
    }

    protected function setting_save(){
        $data = $this->validate(request(),
            [
                'site_name_ar'=> 'required',
                'site_name_en'=> 'required',
                'logo'=> validate_image(),
                'icon'=> validate_image(),
                'email'=> '',
                'descriptions'=> '',
                'keywords'=> '',
                'status'=> '',
                'main_lang' => '',
                'msg_maintenance_ar'=> '',
                'msg_maintenance_en'=> '',
            ],
            [],
            [
                'site_name_ar'=>'اسم الموقع بالعربي',
                'site_name_en'=>"اسم الموقع بالانجليزي",
                'logo'=>"شعار الموقع",
                'icon'=>"ايقونة الموقع"
            ]
        );
        if (request()->hasFile('logo')){
//            !empty(setting()->logo)?Storage::delete(setting()->logo):'';
//            $data['logo'] = request()->file('logo')->store('settings');
            $data['logo'] = upload_file()->upload([
                'file' => 'logo',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->logo
            ]);
        }
        if (request()->hasFile('icon')){
//            !empty(setting()->icon)?Storage::delete(setting()->icon):'';
//            $data['icon'] = request()->file('icon')->store('settings');
            $data['icon'] = upload_file()->upload([
                'file' => 'icon',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->icon
            ]);
        }
        Setting::orderBy('id','desc')->update($data);
        session()->flash('success',"تم تحديث الاعدادات بنجاح");
        return redirect('settings');
    }
}
