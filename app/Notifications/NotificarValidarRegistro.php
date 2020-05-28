<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificarValidarRegistro extends Notification
{
    use Queueable;
    protected $reg;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reg)
    {
        $this->reg=$reg;
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
                    ->subject('Comprobante de registro aprobado')
                    ->line('Comprobante de registro en:')
                    ->line($this->reg->cohorte->maestria->nombre.' COHORTE '.$this->reg->cohorte->numero.', fue aprobado exitosamente')
                    ->line('Para finalizar debe,')
                    ->action('Actualizar la Información Personal, Información Académica e Información Laboral', route('miperfil'))
                    ->line('Realizar la Inscripción en la Secretaría de Posgrado. La inscripción es un trámite personal.');
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
