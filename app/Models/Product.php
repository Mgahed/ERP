<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function subSubCategory()
    {
        return $this->belongsTo(SubSubCategory::class, 'sub_sub_category_id', 'id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }
}
