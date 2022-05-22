<?php

namespace App\Notifications;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
class SendToAdmin extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Request $message)
    {
        $this->message = $message;
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
        $mail = new MailMessage();
        $mail->subject(config('admin.name') . ", новое сообщение с личного кабинета ".getenv('APP_NAME')." !")
        ->greeting(" ")
        ->salutation(" ")
        ->from(getenv('MAIL_FROM_ADDRESS'), getenv('APP_NAME'))
        ->line('<strong>Имя:</strong>' .Auth::user()->name)
        ->line('<strong>E-mail:</strong> ' . Auth::user()->email)
        ->line('<strong>Тема сообщения:</strong>')
        ->line($this->message->tema)
        ->line('<strong>Сообщение:</strong> ')
        ->line(nl2br($this->message->text));

        if ($this->message->attach)
        $mail->attach($this->message->attach);

        return $mail;



    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
