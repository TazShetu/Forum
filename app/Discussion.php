<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Discussion extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'channel_id', 'slug'];

    public function channel(){
        return $this->belongsTo('App\Channel');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function watchers(){
        return $this->hasMany('App\Watcher');
    }

    public function being_watched(){
        $idU = Auth::id();
        $allWatcher = array();
        foreach ($this->watchers as $w):
            array_push($allWatcher, $w->user_id);
        endforeach;
        if (in_array($idU, $allWatcher)){
            return true;
        }else{
            return false;
        }
    }

    public function has_best_ans(){
        $a = false;
        foreach ($this->replies as $reply){
            if ($reply->best_ans){
                $a = true;
                break;
            }
        }
        return $a;
    }


}
















