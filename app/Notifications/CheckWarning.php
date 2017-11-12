<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;
use Spatie\ServerMonitor\Models\Enums\CheckStatus;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Messages\SlackAttachment;
use Spatie\ServerMonitor\Notifications\Notifications\CheckWarning as SpatieCheckWarning ;
use Spatie\ServerMonitor\Events\CheckWarning as CheckWarningEvent;
use ThibaudDauce\Mattermost\MattermostChannel;
use ThibaudDauce\Mattermost\Message as MattermostMessage;
use ThibaudDauce\Mattermost\Attachment as MattermostAttachment ;

class CheckWarning extends SpatieCheckWarning
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
            ->warning()
            ->attachment(function (SlackAttachment $attachment) {
                $attachment
                    ->title($this->getSubject())
                    ->content($this->getMessageText())
                    ->fallback($this->getMessageText())
                    ->timestamp(Carbon::now());
            });
		 */
		return (new MattermostMessage)
		->text( '**WARNING**' )
		->attachment(function ( MattermostAttachment $attachment) {
			$attachment->authorName('Servers Monitor')
			->info()
			->title( $this->getSubject() )
			->text( $this->getMessageText() ); // Markdown supported.
		});
	}
	
}
