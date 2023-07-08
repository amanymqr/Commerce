<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
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

public function getTransNameAttribute() {
    if($this->name){
        return json_decode($this->name ,true)[app()->currentLocale()];
    }return $this->name;
}

public function getNameEnAttribute() {
    if($this->name){
        return json_decode($this->name ,true)['en'];
    }return $this->name;
}

public function getNameArAttribute() {
    if($this->name){
        return json_decode($this->name ,true)['ar'];
    }return $this->name;
}
}
