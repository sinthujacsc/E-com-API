<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblSysToken extends Model
{
    use HasFactory;

    protected $table = 'tbl_sys_tokens';

    protected $fillable = [

        'token_number',
        'user_id',
        'browser',
        'ip_address'
    ];
}
