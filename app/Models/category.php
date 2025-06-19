<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    use HasUuids;
    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public $table = 'categories';
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
     * Mendefinisikan relasi "one-to-many" ke model Product.
     * Satu Kategori memiliki banyak Produk.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
