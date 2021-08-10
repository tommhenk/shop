<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'alias', 'text','img','category_id','keywords','meta_desc', 'price'];

    
    public function properties(){
        return $this->belongsToMany(Property::class, 'product_property');
    }

    public function hasProperty($name, $required = false){
        if(is_array($name)){

            foreach($name as $item){
                $propName = $this->hasProperty($item);
                if (!$propName && $required) {
                    return false;
                }else if ($propName && !$required) {
                    return true;
                }
                return $required;
            }
        }else{
            foreach($this->properties as $prop){
                if (\Str::is($prop->name, $name)) {
                    return true;
                }
            }
            return false;
        }
    }

    // public function scopeHit($query){
    //     return $query->properties()->where('name','hit')->first();
    // }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_product');
    }

    public function isNew(){
        return !!$this->properties()->where('name', 'new')->first();
    }
    public function isHit(){
        return !!$this->properties()->where('name', 'hit')->first();
    }
    public function isRecomend(){
        return !!$this->properties()->where('name', 'recommend')->first();
    }
}
