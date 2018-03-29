<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class comment extends Model {

    public $timestamps = true;

    public function post() {
        return $this->belongsTo(App\Model\user\post::class);
    }

    public function user() {
        return $this->belongsTo(App\Model\user\User::class);
    }

    public function scopeApproved($query) {
        return $query->where('approved', '=', 1);
    }

    public function likes() {
        return $this->hasMany('App\Model\user\commentlike');
    }

    public function replies() {
        return $this->hasMany('App\Model\user\Comment', 'id', 'parent_comment_id');
    }

}
