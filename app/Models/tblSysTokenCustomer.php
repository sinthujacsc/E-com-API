<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblSysTokenCustomer extends Model
{
    use HasFactory;
    protected $table = 'tbl_sys_token_customers';

    protected $fillable = [

        'token_number',
        'user_id',
        'browser',
        'ip_address'
    ];
}
