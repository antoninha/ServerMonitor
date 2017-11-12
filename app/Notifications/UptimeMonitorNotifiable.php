<?php

namespace Spatie\UptimeMonitor\Notifications;

use Illuminate\Notifications\Notifiable as NotifiableTrait;
use Spatie\UptimeMonitor\Notifications\Notifiable as SpatieUptimeMonitorNotifiable ;

class UptimeMonitorNotifiable extends SpatieUptimeMonitorNotifiable
{
	/**
	 * @return string|null
	 */
	public function routeNotificationForSlack()
	{
		return config('uptime-monitor.notifications.mattermost.webhook_url');
	}

}
