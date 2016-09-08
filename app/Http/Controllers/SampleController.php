<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Messenger;

class SampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Messenger $messenger)
    {
        $this->messenger = $messenger;
        // $this->middleware('auth');
    }

    public function codeMonkeysPage() {
        // $test = Sms::send('6164031380','woot');
        $response = Messenger::sendSms('6164031380', 'Hey');
        // try {
        //     $response = Messenger::sendSms('6164031380', 'Hey Lydiah');
        // } catch (Exception $e) {
        //     return $e->getMessage();
        // }
        
        return $response;

        return view('sample.code-monkeys');
    }
}
