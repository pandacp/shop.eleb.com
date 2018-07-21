<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable=['goods_name','goods_img','shop_id','category_id','goods_price','description','tips','rating','month_sales','rating_count','satisfy_count','satisfy_rate'];

    public function Menu_category()
    {
        return $this->belongsTo(Menu_category::class,'category_id','id');
    }


}
