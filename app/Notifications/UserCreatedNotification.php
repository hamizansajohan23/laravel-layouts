    <?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreatedNotification extends Notification
{
    use Queueable;

    /**
     * The plain text password.
     */
    protected string $password;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $password)
    {
        $this->password = $password;
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
            ->subject('Akaun Pengguna Anda Telah Dicipta - '.config('app.name'))
            ->greeting('Assalamualaikum '.$notifiable->name.',')
            ->line('Akaun pengguna anda telah berjaya dicipta dalam sistem.')
            ->line('**Maklumat Log Masuk:**')
            ->line('Emel: '.$notifiable->email)
            ->line('Kata Laluan: '.$this->password)
            ->action('Log Masuk Sekarang', url('/login'))
            ->line('Sila tukar kata laluan anda selepas log masuk buat pertama kali.')
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
            'message' => 'Akaun pengguna telah dicipta.',
        ];
    }
}
