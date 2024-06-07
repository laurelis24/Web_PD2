<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Car extends Model
{
    use HasFactory;

    
        protected $fillable = [
        'model',
        'manufacturer_id',
        'category_id',
        'description',
        'price',
        'year',
    ];
    

    public function manufacturer(): BelongsTo{
        return $this->belongsTo(Manufacturer::class);
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

        public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'model' => $this->model,
            'description' => $this->description,
            'manufacturer' => $this->manufacturer->name,
            'category' => ($this->category ? $this->category->name : ''),
            'price' => number_format($this->price, 2),
            'year' => intval($this->year),
            'image' => asset('images/' . $this->image),
        ];
    }

    
}
