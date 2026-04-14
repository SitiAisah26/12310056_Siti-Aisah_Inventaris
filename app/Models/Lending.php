<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $fillable = [
        'item_id', 'name',
         'total', 
         'date_time', 
         'notes', 
         'is_returned', 
         'user_id', 
         'return_date', 
         'is_password_changed',];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
