<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

//Notificación para informar al usuario de su comentario

class Buzon extends Notification
{
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	//Recibe las variables del Controlador
	public function __construct($body,$cc)
	{
		$this->body = $body;
		$this->cc = $cc;
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
		->cc($this->cc) //Sirve para mandar una copia
		->subject('Buzón, Congreso Jalisco')
		->view(
			'emails.buzon', ['body' => $this->body]
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
