<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saved(function ($product) {
            // Check if the 'status' attribute has changed
            if ($product->status == '1') {
                // Update the associated FlashSaleItem records
                $product->flashSaleItems()->update(['status' => 1]);
            } else {
                $product->flashSaleItems()->update(['status' => 0]);
            }

            // Check if there are FlashOutItem records
            if ($product->flashOutItem()->exists()) {
                // Update the associated FlashOutItem records based on the product status
                if ($product->status == '1') {
                    $product->flashOutItem()->update(['status' => 1]);
                } else {
                    $product->flashOutItem()->update(['status' => 0]);
                }
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImageGalleries()
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function flashSaleItems()
    {
        return $this->hasMany(FlashSaleItem::class);
    }
    public function flashOutItem()
    {
        return $this->hasMany(FlashOutItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

}
