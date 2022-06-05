<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class ContactStore extends Model
{
    use HasFactory;

    protected $table = 'contact_store';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable=['user_id','contact_list'];
    protected $casts = [
        'contact_list' => 'array',//'array',
    ];
}
