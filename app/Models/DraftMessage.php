<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftMessage extends Model
{
    use HasFactory;
    protected $table = 'draft_messages';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable=['id','sender_public_code','receiver_list', 'message', 'options'];
    protected $casts = [
        'message' => 'encrypted:array',
        'receiver_list'=>'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',

    ];
}
