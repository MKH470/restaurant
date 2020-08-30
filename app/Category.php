<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name'];
    public function food(){
        return $this->hasMany(Food::class,'category_id','id');
    }
}
