<?php

namespace App\Notifications;

use Illuminate\Notifications\Notifiable as NotifiableTrait;
use Spatie\ServerMonitor\Notifications\Notifiable as SpatieNotifiable;

class Notifiable extends SpatieNotifiable
{
	/**
	 * Route notifications for the Mattermost channel.
	 *
	 * @return int
	 */
	public function routeNotificationForMattermost()
	{
		return config('server-monitor.notifications.mattermost.webhook_url');
	}
}
