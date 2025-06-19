<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image_path',
    ];
    protected $table = 'products';
    /**
     * Atribut yang harus di-casting ke tipe data tertentu untuk keamanan dan konsistensi.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Mengindikasikan bahwa ID model bukan auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Tipe data dari primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Boot a new instance of the model.
     * Otomatis membuat UUID setiap kali model baru dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    /**
     * Mendefinisikan relasi "belongs-to" ke model Category.
     * Satu Produk dimiliki oleh satu Kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Di dalam model Product
public function orderItems(): HasMany
{
    return $this->hasMany(OrderItem::class);
}
}
