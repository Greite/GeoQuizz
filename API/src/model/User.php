<?php
/**
 *
 */
namespace geo\model;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = "string";
}