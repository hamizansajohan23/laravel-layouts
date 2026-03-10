<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRegistrationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $applicant) {}

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
            ->subject('Permohonan ID Pengguna Baru - '.config('app.name'))
            ->greeting('Salam Sejahtera,')
            ->line('Terdapat permohonan ID pengguna baru yang memerlukan tindakan anda.')
            ->line('**Maklumat Pemohon:**')
            ->line('Nama: '.$this->applicant->name)
            ->line('No. Kad Pengenalan: '.$this->applicant->nokp)
            ->line('Emel: '.$this->applicant->email)
            ->line('Bahagian: '.$this->applicant->bahagian->nama_bahagian)
            ->action('Lihat Senarai Permohonan', route('admin.pendaftaran.index'))
            ->line('Sila log masuk ke sistem untuk meluluskan atau menolak permohonan ini.')
            ->salutation('Sekian, Sistem Notifikasi Automatik');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'applicant_id' => $this->applicant->id,
            'applicant_name' => $this->applicant->name,
            'message' => 'Permohonan ID pengguna baru daripada '.$this->applicant->name,
        ];
    }
}
