<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cvanh;

class api extends Controller
{
    private $cal;
    /**
     * Create a new controller instance.
     *
     * @return void  
     */
    public function __construct()
    {
        $this->cal = new Cvanh\Kalender("493c74795eb74003a54f8eb7e618f65f08f41a0712b6407f812a4ee79c3af7b5");
    }

    function get(){
        $a = $this->cal->getavailability("493c74795eb74003a54f8eb7e618f65f08f41a0712b6407f812a4ee79c3af7b5");
         header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal.ics"');
        echo($a);
    }
}
