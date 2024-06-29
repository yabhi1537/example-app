<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class EventRegistration extends Model
{
    protected $table = 'event_registration';


    protected $fillable = ['name','mobile_no','address','status','fee','order_id','transaction_id'];


    /* 
		status : 0 => progress, 1 => Fail, 2 => Successful
    */
}