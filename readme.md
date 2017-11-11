
## ServersMonitor

Built on [Spatie laravel-server-monitor](https://docs.spatie.be/laravel-server-monitor/v1/introduction).

Mattermost notification on [ThibaudDauce laravel-notifications-mattermost](https://github.com/ThibaudDauce/laravel-notifications-mattermost).

## Installation

### Get the code

```
git clone git@framagit.org:Cyrille37/ServersMonitor.git
```
or just download archive [ZIP](https://framagit.org/Cyrille37/ServersMonitor/repository/master/archive.zip) or [TAR.GZ](https://framagit.org/Cyrille37/ServersMonitor/repository/master/archive.tar.gz).
 
### install the software

```
$ composer install
$ cp .env.example .env
$ ./artisan key:generate
```

### configuration

Adapt configuration via `.env` file.

Then follow instructions for [managing-hosts](https://docs.spatie.be/laravel-server-monitor/v1/monitoring-basics/managing-hosts).

### Schedule jobs

Add a system cron job to schedule the application execution every minute: 
```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Laravel

Made with love with Laravel & packages creators (like [Spatie](https://spatie.be)).

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
