<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OderDetail extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable =
    ['oder_code','product_id','product_name','product_price','product_sales_quantity'];
    protected $primaryKey = 'oder_detail_id';
    protected $table = 'tbl_oder_detail';

    public function product(){
        // belongsTo vì mỗi sản phẩm trong oder_detail nó chỉ thuộc 1 sản phảm trong product
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
