<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_category extends Model
{
    //
    protected $fillable=['name','type_accumulation','shop_id','description','is_selected'];
    //分类里的所属商家id 和 商家id 关联
    public function shop()
    {
        return $this->hasOne(Shop::class,'id','shop_id');
    }

    public function Menu()
    {
        return $this->hasMany(Menu::class,'category_id','id');
    }
}
