<?php

class Group extends Eloquent {

    protected $table = 'groups';

    protected $fillable = array('id', 'name', 'desc');

    public function members()
    {
        return $this->belongsToMany('User', 'group_members', 'group_id', 'member_id');
    }
}