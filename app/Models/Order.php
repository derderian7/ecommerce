<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_items;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'email',
        'phonenumber',
        'address',
        'status',
        'message',
        'tracking_no',
    ];
    public function orderitems()
    {
        return $this->hasMany(Order_items::class);
    }
}
