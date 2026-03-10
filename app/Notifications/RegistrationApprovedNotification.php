<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationApprovedNotification extends Notification
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
            ->subject('Pendaftaran Anda Telah Diluluskan - '.config('app.name'))
            ->greeting('Assalamualaikum '.$notifiable->name.',')
            ->line('Tahniah! Pendaftaran anda telah diluluskan oleh pentadbir.')
            ->line('Anda kini boleh log masuk ke dalam sistem menggunakan emel dan kata laluan yang telah didaftarkan.')
            ->action('Log Masuk Sekarang', url('/login'))
            ->line('Jika anda mempunyai sebarang pertanyaan, sila hubungi pentadbir sistem.')
            ->line('Terima kasih kerana menggunakan sistem kami.')
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
            'message' => 'Pendaftaran telah diluluskan.',
        ];
    }
}
