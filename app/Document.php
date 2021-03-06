<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    
    protected $table = 'documents';

    protected $fillable = [
        'uuid', 'title', 'number', 'year'
    ];

    // RELATIONSHIP
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

}
