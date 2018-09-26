<?php

namespace App\Http\Controllers\Site;

use App\Models\Common\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SubscriberController extends Controller
{
    public function activate(Request $request)
    {
        $hash = $request->get('hash');

        Subscriber::where('hash', $hash)->update(['state' => 1]);

        Session::flash('flash_message', 'Ваш e-mail подтверждён');

        return redirect('/');
    }
}
