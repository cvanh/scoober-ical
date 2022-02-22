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
        var_dump($user);
        if (!$user) {
            $data = $request->all();
            $scoober_token = (new Cvanh\Scoober(""))->get_accestoken($data["email"],$data["password"]);
            $uuid = Uuid::v4();
            DB::insert("INSERT INTO user (id, email, discord_token, scoober, uid) VALUES (NULL, '{$data["email"]}', '{$data["discord_token"]}', '{$scoober_token->accessToken}', '{$uuid}')");
            return $uuid;
        }
        echo "kaas";
    }
}
