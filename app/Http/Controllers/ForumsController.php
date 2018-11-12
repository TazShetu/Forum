<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Channel;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function index(){
//        $dis = Discussion::orderBy('created_at', 'desc')->paginate(3);
//        return view('forum', ['discussions' => $dis]);
//        // trying something different rather than compact()

        // with FILTER
        switch (request('filter')){
            case 'me':
                $results = Discussion::where('user_id', Auth::id())->paginate(3);
                break;
            case 'solved':
                $solvedD = array();
                foreach (Discussion::all() as $d){
                    if($d->has_best_ans()){
                        array_push($solvedD, $d);
                    }
                }
                $results = new Paginator($solvedD, 3);
                break;
            case 'unsolved':
                $unsolvedD = array();
                foreach (Discussion::all() as $d){
                    if(!$d->has_best_ans()){
                        array_push($unsolvedD, $d);
                    }
                }
                $results = new Paginator($unsolvedD, 3);
                break;
            // default is route without filter
            default:
                $results = Discussion::orderBy('created_at', 'desc')->paginate(3);
                break;
        }

        return view('forum', ['discussions' => $results]);
    }

    public function channelD($slug){
        $c = Channel::where('slug', $slug)->first();
        $discussions = $c->discussions()->paginate(1);
        return view('channels.show', compact('discussions', 'c'));
    }



}
