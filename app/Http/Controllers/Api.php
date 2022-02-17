<?php

namespace App\Http\Controllers;
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
}
