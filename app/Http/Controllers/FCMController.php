<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Routing\Controller as BaseController;

class FCMController extends BaseController{

    function send(){
        $token = "c_gTVCgbzU2WkIpfTq4btO:APA91bHkgzFsqS09qRN1kD1D0czcF6FCk2iuB4ZLW7vbGcCoTjofzwqp4_J8zG28nsAYcJjwkhP7dQw3VJAhkecgQDI-5dkoR5Erzhr5RvPUdpWkk3JvVRpejFwU8SPVdCPoDgWXKTt1";
        $apiKeys = "AAAA-iNFEFM:APA91bFq9ibNy4HEDafxhmzJ7feZv0hT2xmPWCmaBTopd5fmmXI2ids32niwWDQZjwdxIx_zRLUDZ2PF8bNzc4wd4q9E4gQV4rSeXxzb5kMS-BAXGnEMcIEgjwhtsg4WNS_sG4vNXtkU";
        $msg = array
        (
            'title' => "Hi, Abdu",
            'body'  => "Testing Demo",
            'name' => "Hi, Abdu",
            'desc' => 'abdu test url',
            'start' => '12-12-2020',
            'end' => '02-02-2021',
            'id' => '10',
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array
        (
            'to'        => $token,
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
//        if (curl_error($ch)){
//            session()->flash("");
//        }
        dd($result);
    }

    /**
     * @param $userID
     * @return HigherOrderBuilderProxy|mixed
     */
    function approveVolunteer($userID){
        $v = Volunteer::query()->where('id',$userID)->first();
        return '<center><h1>'.$v->name.
            '</h1></center>'.
            '<center><h3>تم التحضير</h3></center>';
    }
}
