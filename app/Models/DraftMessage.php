<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class DraftMessage extends Model
{
    use HasFactory;
    use Searchable;

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
    public function toSearchableArray(){
        return [
            'receiver_list' => $this->receiver_list,
            'message'=>$this->message
        ];
    }
}
