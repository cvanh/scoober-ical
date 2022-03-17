<?php

namespace App\Http\Controllers;

use Jchook\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Cvanh;

class Api extends Controller
{
    function getschedule($uid)
    {
        $user = DB::table("user")->where("uid", $uid)->first();

        // init planning class and fetch the availability
        $ical = (new Cvanh\Planning())->getavailability($user->scoober);

        // set the correct headers so user can download a .ics file 
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal.ics"');
        return $ical;
    }
    function getuid()
    {

        return "uid";
    }
    function login(Request $request)
    {
        $user = DB::table("user")
            ->where("email", $request->input("email"))
            ->orWhere("password",$request->input("password")) 
            ->first();

        if (!$user) {
            $scoober_token = json_decode((new Cvanh\Scoober(""))->get_accestoken($request->email, $request->password));

            if($scoober_token->body->accessToken){
            $uuid = Uuid::v4(); // for later use
            DB::insert("INSERT INTO user (id, email,password , scoober, uid) VALUES (NULL, '{$request->email}','{$request->password}}', '{$scoober_token->body->accessToken}', '{$uuid}')");
            
            // send data so the new user login doesnt fail 
            $data = [];
            $data["uid"] = $uuid;
            $data["email"] = $request->email;
            echo json_encode($data);
            } else{
                echo "failed";
            }
        } else {
            echo json_encode($user);
        }
    }
}
