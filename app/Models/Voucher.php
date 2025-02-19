<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parables\Cuid\CuidAsPrimaryKey;
use Parables\Cuid\GeneratesCuid;

class Voucher extends Model
{
    use GeneratesCuid, CuidAsPrimaryKey;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = ['id'];

    public static function cuidColumn(): string
    {
        return 'id';
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'voucher_users', 'voucher_id', 'user_id')->withPivot('is_used');
    }
}
