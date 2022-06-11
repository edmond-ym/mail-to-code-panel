<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrivateCode extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'private_code';
    protected $primaryKey = 'secret_code';
    public $incrementing = false;
    protected $fillable=['secret_code', 'user_id', 'nickname'];
    protected $casts=[
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',

    ];
}
