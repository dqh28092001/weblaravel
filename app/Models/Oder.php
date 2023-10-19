<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable =
    ['customer_id','shipping_id','oder_status','oder_code','created_at'];
    protected $primaryKey = 'oder_id';
    protected $table = 'tbl_oder';


}
