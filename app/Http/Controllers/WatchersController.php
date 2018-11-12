<?php

namespace App\Http\Controllers;

use App\Watcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WatchersController extends Controller
{
    public function watch($id){
        Watcher::create([
            'discussion_id' => $id,
            'user_id' => Auth::id()
        ]);
        Session::flash('success', 'You will get Update for this Discussion through Email');
        return redirect()->back();
    }

    public function unwatch($id){
        $w = Watcher::where('discussion_id', $id)->where('user_id', Auth::id());
        $w->delete();
        Session::flash('success', 'You will no longer get Update');
        return redirect()->back();
    }

}
