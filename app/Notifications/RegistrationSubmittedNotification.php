<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationSubmittedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pendaftaran Berjaya Dihantar - '.config('app.name'))
            ->greeting('Assalamualaikum '.$notifiable->name.',')
            ->line('Terima kasih kerana mendaftar dalam sistem kami.')
            ->line('Pendaftaran anda telah berjaya dihantar dan sedang menunggu kelulusan daripada pentadbir.')
            ->line('**Maklumat Pendaftaran:**')
            ->line('Nama: '.$notifiable->name)
            ->line('Emel: '.$notifiable->email)
            ->line('No. Kad Pengenalan: '.$notifiable->nokp)
            ->line('Anda akan menerima emel pemberitahuan setelah akaun anda diluluskan.')
            ->line('Terima kasih atas kesabaran anda.')
            ->salutation('Sekian, Pentadbir Sistem');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Pendaftaran berjaya dihantar.',
        ];
    }
}
