<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parables\Cuid\CuidAsPrimaryKey;
use Parables\Cuid\GeneratesCuid;

class Wishlist extends Model
{
    use GeneratesCuid, CuidAsPrimaryKey;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];

    public static function cuidColumn(): string
    {
        return 'id';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
