<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TravelOrderStatusUpdated extends Notification
{
    protected $travelOrder;

    public function __construct($travelOrder)
    {
        $this->travelOrder = $travelOrder;
    }

    public function via($notifiable)
    {
        return ['mail']; // Pode adicionar 'database' ou outros canais
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("Your travel order to {$this->travelOrder->destination} has been {$this->travelOrder->status}.")
                    ->action('View Details', url("/travel-orders/{$this->travelOrder->id}"))
                    ->line('Thank you for using our service!');
    }
}
