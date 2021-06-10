<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

//Notificación para al usuario de que su comentario fue aprobado

class ComentarioAprobado extends Notification
{
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	//Recibe las variables del Controlador
	public function __construct($data, $comentario)
	{
		$this->data = $data;
		$this->comentario = $comentario;
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
		->subject('Comentario Aprobado con éxito, Congreso Jalisco')
		->view(
			'emails.comentario_aprobado', ['data' => $this->data,'comentario' => $this->comentario]
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
