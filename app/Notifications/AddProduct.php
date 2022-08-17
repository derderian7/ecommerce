<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AddProduct extends Notification
{
    use Queueable;
    private $product_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Product $product_id)
    {
        $this->product_id = $product_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        return [
            'id'=> $this->product_id->id,
            'title'=>'A new product is added by: ',
            'user'=> Auth::user()->name,
        ];
    }
}
