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
        $user = DB::table("user")->where("email", $request->input("email"))->first();
        // var_dump($user);
        file_put_contents("php://stdout",    $request->email);
        file_put_contents("php://stdout", $request->password);
        if (!$user) {
            $scoober_token = json_decode((new Cvanh\Scoober(""))->get_accestoken($request->email, $request->password));
            $uuid = Uuid::v4();
            DB::insert("INSERT INTO user (id, email,password , scoober, uid) VALUES (NULL, '{$request->email}','{$request->password}}', '{$scoober_token->body->accessToken}', '{$uuid}')");
            echo $scoober_token->body->accessToken;
        } else {
            echo json_encode($user);
        }
    }
}
