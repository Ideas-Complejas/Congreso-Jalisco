<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

//Notificación para informar a los usuarios que pertenecen a esa comisión de que hay un nuevo comentario
class ComentarioComision extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $iniciativa,$folio)
    {
        $this->data = $data;
        $this->iniciativa = $iniciativa;
         $this->folio = $folio;
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
        ->subject('Nuevo Comentario, Congreso Jalisco')
        ->view(
            'emails.comentario_comision', ['data' => $this->data,'iniciativa' => $this->iniciativa, 'folio' => $this->folio]
        );


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
