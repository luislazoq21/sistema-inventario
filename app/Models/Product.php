<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sku',
        'barcode',
        'price',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function purchaseOrders(): MorphToMany
    {
        return $this->morphedByMany(PurchaseOrder::class, 'productable');
    }

    public function quotes(): MorphToMany
    {
        return $this->morphedByMany(Quote::class, 'productable');
    }

    // Accessor
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->images()->count()
                            ? Storage::url($this->images()->first()->path)
                            : 'https://t4.ftcdn.net/jpg/05/97/47/95/360_F_597479556_7bbQ7t4Z8k3xbAloHFHVdZIizWK1PdOo.jpg',
        );
    }
}
