<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Events(){
        $calendardata = array
                      (
                        "0" => array
                                  (
                                   "title" => "Event One",
                                   "start" => "2019-01-09",
                                   ),
                        "1" => array
                                   (
                                    "title" => "Event Two",
                                    "start" => "2019-01-06",
                                    )
                      );
        return response()->json(["calendardata" => $calendardata]);
    }
}
