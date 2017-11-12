<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Messages\SlackAttachment;
use Spatie\ServerMonitor\Notifications\Notifications\CheckFailed as SpatieCheckFailed ;
use Spatie\ServerMonitor\Events\CheckFailed as CheckFailedEvent;
use ThibaudDauce\Mattermost\MattermostChannel;
use ThibaudDauce\Mattermost\Message as MattermostMessage;
use ThibaudDauce\Mattermost\Attachment as MattermostAttachment ;

class CheckFailed extends SpatieCheckFailed
{
	/**
	 * Get the Mattermost representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \ThibaudDauce\Mattermost\Message
	 */
	public function toMattermost($notifiable)
	{
		/*
        return (new SlackMessage)
            ->error()
            ->attachment(function (SlackAttachment $attachment) {
                $attachment
                    ->title($this->getSubject())
                    ->content($this->getMessageText())
                    ->fallback($this->getMessageText())
                    ->timestamp(Carbon::now());
            });
		 */
		/*
		return (new MattermostMessage)
		->username('Helpdesk')
		->iconUrl(url('/images/logo_only.png'))
		->text("A new ticket has been opened.")
		->attachment(function ($attachment) {
			$attachment->authorName($notifiable->name)
			->title("[Ticket #1] Title of the ticket", '/tickets/1')
			->text("Message of **the ticket**"); // Markdown supported.
		});
		*/
		return (new MattermostMessage)
		->text( '**ERROR**' )
		->attachment(function ( MattermostAttachment $attachment) {
			$attachment->authorName('Servers Monitor')
			->title( $this->getSubject() )
			->text( $this->getMessageText() ); // Markdown supported.
		});
	}

}
