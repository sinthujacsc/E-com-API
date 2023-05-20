<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblCustomerEnquiry extends Model
{
    use HasFactory;
    protected $table = 'tbl_customer_enquiries';

    protected $fillable = [

        'name',
        'email',
        'subject',
        'message',
        'phone',
        'isViewed'
    ];
}
