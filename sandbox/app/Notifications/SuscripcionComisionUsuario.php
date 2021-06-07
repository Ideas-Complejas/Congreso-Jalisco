<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

//Notificación para al usuario de su suscripción a la(s) comision(es)

class SuscripcionComisionUsuario extends Notification
{
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	//Recibe las variables del Controlador
	public function __construct($data, $nombre_comisiones)
	{
		$this->data = $data;
		$this->nombre_comisiones = $nombre_comisiones;
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
			'emails.suscripcion_comisiones_usuario', ['data' => $this->data,'nombre_comisiones' => $this->nombre_comisiones]
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
