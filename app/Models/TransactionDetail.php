<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parables\Cuid\CuidAsPrimaryKey;
use Parables\Cuid\GeneratesCuid;

class TransactionDetail extends Model
{
    use GeneratesCuid, CuidAsPrimaryKey;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];

    public static function cuidColumn(): string
    {
        return 'id';
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
