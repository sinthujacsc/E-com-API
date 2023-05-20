<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblProductImage extends Model
{
    use HasFactory;
    protected $table = 'tbl_product_images';

    protected $fillable = [

        'imgPath',
        'color',
        'product_id'
    ];
    public function tbl_products()
    {
        return $this->belongsTo(tblProduct::class,  'custId');
    }

}
