<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewReplyAdded extends Notification
{
    use Queueable;

    public $discussion;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($d)
    {
        $this->discussion = $d;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting("Hello from Taz's Forum")
                    ->line('Someone replied to a discussion you are interested in.')
//                    ->action('View Discussion', url('/'))
                    ->action('View Discussion', route('discussion', ['slug' => $this->discussion->slug]))
                    ->line('Thank you for using our forum!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
//    public function toArray($notifiable)
//    {
//        return [
//            //
//        ];
//    }
}
