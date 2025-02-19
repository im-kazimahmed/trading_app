<?php

namespace Laramin\Utility\Controller;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Laramin\Utility\VugiChugi;

class UtilityController extends Controller{

    public function laraminStart()
    {
        $pageTitle = VugiChugi::lsTitle();
        return view('Utility::laramin_start',compact('pageTitle'));
    }

    public function laraminSubmit(Request $request){
        // $param['code'] = $request->purchase_code;
        $param['url'] = env("APP_URL");
        // $param['user'] = $request->envato_username;
        // $param['email'] = $request->email;
        // $param['product'] = systemDetails()['name'];
        // $reqRoute = VugiChugi::lcLabSbm();
        // $response = CurlRequest::curlPostContent($reqRoute, $param);
        // $response = json_decode($response);

        // if ($response->error == 'error') {
        //     return response()->json(['type'=>'error','message'=>$response->message]);
        // }

        $env = $_ENV;
        $env['PURCHASECODE'] = 12334565461;
        $envString = '';
        $requiredEnv = ['APP_NAME', 'APP_ENV', 'APP_KEY', 'APP_DEBUG', 'APP_URL', 'LOG_CHANNEL', 'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD','PURCHASECODE'];
        foreach($env as $k => $en){
if(in_array($k , $requiredEnv)){
$envString .= $k.'='.$en.'
';
}
        }

        $envLocation = substr($response->location,3);
        $envFile = fopen($envLocation, "w");
        fwrite($envFile, $envString);
        fclose($envFile);

        $laramin = fopen(dirname(__DIR__).'/laramin.json', "w");
        $txt = '{
    "purchase_code":'.'"'.$request->purchase_code.'",'.'
    "installcode":'.'"'.@$response->installcode.'",'.'
    "license_type":'.'"'.@$response->license_type.'"'.'
}';
        fwrite($laramin, $txt);
        fclose($laramin);

        $general = GeneralSetting::first();
        $general->maintenance_mode = 0;
        $general->save();

        return response()->json(['type'=>'success']);

    }
}
