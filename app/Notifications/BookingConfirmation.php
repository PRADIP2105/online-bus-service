<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingConfirmation extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Booking Confirmation')
                    ->line('Your booking has been confirmed!')
                    ->line('Bus: ' . $this->booking->schedule->bus->name)
                    ->line('Route: ' . $this->booking->schedule->source . ' to ' . $this->booking->schedule->destination)
                    ->line('Seat: ' . $this->booking->seat_number)
                    ->line('Price: $' . $this->booking->total_price)
                    ->action('View Booking', route('bookings.index'));
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Booking confirmed for ' . $this->booking->schedule->source . ' to ' . $this->booking->schedule->destination . ' (Seat: ' . $this->booking->seat_number . ')',
        ];
    }
}