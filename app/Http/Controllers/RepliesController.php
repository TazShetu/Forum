<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use App\User;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class RepliesController extends Controller
{
    public function reply($id){
        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'body' => request()->reply
        ]);
        $reply->user->points += 25;
        // now we need to save that not in reply sondern in user
        $reply->user->save();

        // Notification
        $d = Discussion::find($id);
        $allWatcher = array();
        foreach ($d->watchers as $w):
//            array_push($allWatcher, $w->user_id);
            // before we only needed the user_id, now we need all the info
            array_push($allWatcher, User::find($w->user_id));
        endforeach;
        //dd($allWatcher);
        Notification::send($allWatcher, new \App\Notifications\NewReplyAdded($d));
        //NewReplyAdded() is from NewReplyAdded.php which use App\Notifications namespace
        // we can see them in NewReplyAdded.php



        Session::flash('success', 'Replied to the Discussion');
        return redirect()->back();
    }

    public function like($id){
//        $reply = Reply::find($id);
        Like::create([
            'reply_id' => $id,
            'user_id' => Auth::id()
        ]);
        Session::flash('success', 'You liked the reply');
        return redirect()->back();
    }

    public function unlike($id){
        $l = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();
        $l->delete();
        Session::flash('success', 'You unliked the reply');
        return redirect()->back();
    }

    public function best_ans($did, $rid){
        // here $id received is reply id
        $a = Reply::all();
        $b = $a->where('discussion_id', $did)->where('best_ans', 1)->first();
        if ($b){
            $b->best_ans = 0;
            $b->save();
            $b->user->points -= 100;
            $b->user->save();
        }


        $r = Reply::find($rid);
        $r->best_ans = 1;
        $r->save();
        $r->user->points += 100;
        $r->user->save();
        Session::flash('success', 'Reply has been marked as best answer');
        return redirect()->back();
    }

    public function edit($id){
        $reply = Reply::find($id);
        return view('replies.edit', compact('reply'));
    }


    public function update($id){
        $this->validate(request(), [
            'body' => 'required'
        ]);
        $r = Reply::find($id);
        $r->body = request()->body;
        $r->save();
        Session::flash('success', 'Reply Updated');
        return redirect()->route('discussion', ['slug' => $r->discussion->slug]);
    }



}
