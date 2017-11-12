<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Illuminate\Notifications\Messages\SlackAttachment;
use Spatie\UptimeMonitor\Notifications\BaseNotification;
use Spatie\UptimeMonitor\Events\UptimeCheckRecovered as MonitorRecoveredEvent;
use Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckRecovered as SpatieUptimeCheckRecovered ;
use ThibaudDauce\Mattermost\Message as MattermostMessage;
use ThibaudDauce\Mattermost\Attachment as MattermostAttachment ;

class UptimeCheckRecovered extends SpatieUptimeCheckRecovered
{
	/*
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->success()
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
