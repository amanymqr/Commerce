<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,Trans;
    protected $guarded=[];
    // protected $fillable=['name' , 'image' ,'parent_id'];
    //الحقول المسموحة تعدي

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id')->withDefault();
    }

    public function childrens(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
