<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class tblFaq1 extends Model
{
    use HasFactory, Notifiable,LogsActivity;


    protected static $logAttributes = ['question','answer','faqcategory_id'];

    protected static $ignoreChangedAttributes = ['password','updates_at'];

    protected static $recordEvents = ['Created' ,'Updated'];

    protected static $logOnDirty = true;

    protected static $logName = 'FAQs';

    

    public function getDescriptionForEvent(string $eventName):string
    {
        return "You have {$eventName} FAQs";
    }
    protected $table="tbl_faqs";

    
    protected $fillable = [

        'faqcategory_id',
        'question',
        'answer',
        'isActive'
    ];

   

    public function tbl_faq_categories()
    {
        return $this->belongsTo(tblFaqCategory1::class, 'custId');
    }
}
