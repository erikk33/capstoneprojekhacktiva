<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class UserInteraction extends Model
{
    protected $table = 'user_interactions';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'interaction_type',
        'product_id',
        'category_id'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    /**
     * Get the user that owns the interaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product associated with the interaction.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the category associated with the interaction.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the readable interaction type.
     */
    public function getInteractionTypeTextAttribute(): string
    {
        return match ($this->interaction_type) {
            'view' => 'Lihat Produk',
            'add_to_cart' => 'Tambah ke Keranjang',
            'purchase' => 'Pembelian',
            'recommendation_shown' => 'Rekomendasi Ditampilkan',
            default => ucfirst(str_replace('_', ' ', $this->interaction_type)),
        };
    }
}