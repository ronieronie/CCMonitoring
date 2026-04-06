<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    // Optional if you want to explicitly set the table
    protected $table = 'credit_cards';

    // Fillable fields
     protected $guarded = [];
}
