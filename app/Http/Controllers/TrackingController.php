<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\UserTracking;
use Illuminate\Http\Request;
use App\Notifications\NotifyUserNotification;
use Illuminate\Database\ConnectionInterface as DB;

class TrackingController extends Controller
{
    /**
     * @var $userTracking
     * @var $tracking
     * @var $db
     */
    public $userTracking;
    public $tracking;
    public $db;

    /**
     * @param UserTracking $userTracking
     * @param Tracking $tracking
     * @param DB $db
     */
    public function __construct(Tracking $tracking, DB $db, UserTracking $userTracking)
    {
        $this->userTracking = $userTracking;
        $this->tracking = $tracking;
        $this->db = $db;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $location = 'pretoria';

        //abandoned feature due loadshedding issues
        //$location = Http::get('https://ip-api.com/')['name'];

        $agent = $request->server('HTTP_USER_AGENT');

        $user_tracking = $this->userTracking->whereUserId($user->id)->first();

        $results = $this->db->select($this->db->raw("
                        select * from user_trackings ut
                        left join users u on ut.user_id = u.id
                        left join trackings t on ut.tracking_id = t.id
                        where u.id = :id and t.browser = :browser and t.location = :location"
        ), array(
                'id' => $user->id,
                'browser' => $agent,
                'location' => $location
        ));

        if(!empty($results) && $user_tracking !== null) {
                //notify user of new login from new browser
                $user->notify(new NotifyUserNotification());

        } else {
            $tracking = new $this->tracking();
            $tracking->ip = $request->ip();
            $tracking->location = $location;
            $tracking->time = date('Y-m-d H:i:s');;
            $tracking->browser = $agent;
            $tracking->save();

            $user->tracking()->attach($tracking);
        }

        return response()->json(['success' => true, 'message' => 'Ok']);

    }
}
