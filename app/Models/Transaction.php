<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parables\Cuid\CuidAsPrimaryKey;
use Parables\Cuid\GeneratesCuid;

class Transaction extends Model
{
    use GeneratesCuid, CuidAsPrimaryKey;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];

    public static function cuidColumn(): string
    {
        return 'id';
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_details', 'transaction_id', 'product_id')->withPivot('qty', 'price');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
