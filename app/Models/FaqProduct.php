<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqProduct extends Model
{
    use HasFactory;
    protected $table = 'faqproduct';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'category_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'services_id', 'id');
    }

}
