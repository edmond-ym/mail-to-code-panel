<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyMessage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'my_messages';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable=['id','sender_public_code','receiver_public_code', 'receiver_private_code', 'message'];
    protected $casts = [
        'message' => 'encrypted:array',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    
}
