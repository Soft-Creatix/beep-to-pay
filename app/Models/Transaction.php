<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'total_amount', 'vendor_name', 'vendor_image', 'user_id', 'card_id', 'order_id', 'order_details', 'transaction_details', 'status'
    ];
}
