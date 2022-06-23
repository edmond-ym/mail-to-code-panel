<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class SentMessage extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $table = 'sent_messages';
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
    public function toSearchableArray(){
        return [
            'receiver_list' => $this->receiver_list,
            'message'=>$this->message
        ];
    }
}
