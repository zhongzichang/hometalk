<?php
namespace Zzc\Chat\Model;
class Group extends Eloquent {

    public function members()
    {
        return $this->belongsToMany('User', 'group_members', 'group_id', 'member_id');
    }
}