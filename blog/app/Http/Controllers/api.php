<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cvanh;

class api extends Controller
{
    function get($uid)
    {
        $cal = new Cvanh\Planning();
        $ical = $cal->getavailability($uid);
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal.ics"');
        return $ical;
    }
}
