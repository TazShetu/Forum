<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DiscussionsController extends Controller
{
    public function create(){
        return view('discussions.create');
    }

    public function store(){
        //dd(request());
        $r = request();
        $this->validate($r, [
            'channel_id' => 'required',
            'body' => 'required',
            'title' => 'required'
        ]);
        $dis = Discussion::create([
            'title' => $r->title,
            'channel_id' => $r->channel_id,
            'body' => $r->body,
            'user_id' => Auth::id(),
            'slug' => str_slug($r->title)
        ]);
        Session::flash('success', 'Discussion created Successfully.');
        return redirect()->route('discussion', ['slug' => $dis->slug]);
        }

    public function show($slug){
        $discussion = Discussion::where('slug', $slug)->first();
        $best_reply = $discussion->replies()->where('best_ans', 1)->first();
        // here best_reply is an object (1 reply column)
        return view('discussions.show', compact('discussion', 'best_reply'));
    }

    public function edit($slug){
        $discussion = Discussion::where('slug', $slug)->first();
        return view('discussions.edit', compact('discussion'));
    }

    public function update($id){
        $this->validate(request(), [
            'body' => 'required'
        ]);
        $d = Discussion::find($id);
        $d->body = request()->body;
        $d->save();
        Session::flash('success', 'Discussion updated Successfully.');
        return redirect()->route('discussion', ['slug' => $d->slug]);
    }


}
