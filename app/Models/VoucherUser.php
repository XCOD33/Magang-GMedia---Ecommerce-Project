<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Parables\Cuid\CuidAsPrimaryKey;
use Parables\Cuid\GeneratesCuid;

class VoucherUser extends Model
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
        return $this->hasMany(User::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
