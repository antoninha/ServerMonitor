<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Illuminate\Notifications\Messages\SlackAttachment;
use Spatie\UptimeMonitor\Notifications\BaseNotification;
use Spatie\UptimeMonitor\Events\UptimeCheckSucceeded as MonitorSucceededEvent;
use Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckSucceeded as SpatieUptimeCheckSucceeded ;

class UptimeCheckSucceeded extends SpatieUptimeCheckSucceeded
{

	/*
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->attachment(function (SlackAttachment $attachment) {
                $attachment
                    ->title($this->getMessageText())
                    ->fallback($this->getMessageText())
                    ->footer($this->getLocationDescription())
                    ->timestamp(Carbon::now());
            });
    }
    */

	/**
	 * Get the Mattermost representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \ThibaudDauce\Mattermost\Message
	 */
	public function toMattermost($notifiable)
	{
		return (new MattermostMessage)
		->text( '**SUCCESS**' )
		->attachment(function ( MattermostAttachment $attachment) {
			$attachment->authorName('Servers Monitor')
			->success()
			->title( $this->getMessageText() )
			->text( $this->getMonitor()->uptime_check_failure_reason ); // Markdown supported.
		});
	}

}
