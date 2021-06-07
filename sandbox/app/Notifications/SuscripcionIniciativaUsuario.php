<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

//Notificación para al usuario de su suscripción a la(s) iniciativa(s)

class SuscripcionIniciativaUsuario extends Notification
{
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	//Recibe las variables del Controlador
	public function __construct($data, $nombre_iniciativas)
	{
		$this->data = $data;
		$this->nombre_iniciativas = $nombre_iniciativas;
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
		//Hace el envío del mensaje, pasando al view las variables
		return (new MailMessage)
		->subject('Suscripción realizada con éxito, Congreso Jalisco')
		->view(
			'emails.suscripcion_iniciativas_usuario', ['data' => $this->data,'nombre_iniciativas' => $this->nombre_iniciativas]
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
