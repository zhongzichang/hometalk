<?php
namespace Zzc\Chat\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    public function members()
    {
        return $this->belongsToMany('User', 'group_members', 'group_id', 'member_id');
    }
}