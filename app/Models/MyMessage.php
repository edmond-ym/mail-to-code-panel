<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class MyMessage extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

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

    //#[SearchUsingPrefix(['receiver_public_code'])]
    //#[SearchUsingFullText(['bio'])]
    public function toSearchableArray(){
        return [
            'sender_public_code' => $this->sender_public_code,
            'message'=>$this->message
        ];
    }
    
}
