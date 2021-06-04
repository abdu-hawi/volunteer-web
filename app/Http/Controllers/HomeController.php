<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        auth()->user()->update(['device_token'=>csrf_token()]);
        return view('firebase');
    }

    /**
     * Write code on Method
     *
     * @return JsonResponse()
     */
    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    /**
     * Write code on Method
     *
     * @return void()
     */
    public function sendNotification(Request $request)
    {
        $firebaseToken = "e8DeJvrvIJjkKOEsPbPhPS:APA91bFmK_khBKqktWhCsicWmsih9_EDlfHj9weX9lDK14SFcHYeTwqYLJ25U6G56MAfljVrHjEvKY4fL0aEWR4UQPx6kP1R89nAthkYZtCQSPfahmY98wfrUatS8DB7U4f4zbzhV60Q";
        $SERVER_API_KEY = 'AAAAyMclORw:APA91bHXm6ZA-GyjUBeqPlaSUSY2EQQuRwomPARIeic-vFJp9jD6sz7W6-Xeqd9XoRsnMwhCgjyv362Q1FM2D0JXRS6EieD5LUD2nuqejTU8bCeUNqXS9qFjt9n9eAWzsE4mSEvFXhWe';
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        define("GOOGLE_API_KEY", 'AAAAyMclORw:APA91bHXm6ZA-GyjUBeqPlaSUSY2EQQuRwomPARIeic-vFJp9jD6sz7W6-Xeqd9XoRsnMwhCgjyv362Q1FM2D0JXRS6EieD5LUD2nuqejTU8bCeUNqXS9qFjt9n9eAWzsE4mSEvFXhWe');
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
        dd('abdu:'.$response);
    }
}
