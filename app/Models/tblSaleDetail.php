<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblSaleDetail extends Model
{
    use HasFactory;
    protected $primaryKey ='tranId';

    public function tblSaleBrief(){
        return $this->belongsTo(tblSaleBrief::class,'saleBriefId','custId');
    }

    public function Product(){
        return $this->belongsTo(tblProduct::class, 'itemId','custId');
    }
}
