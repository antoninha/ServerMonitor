<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::post('/server-monitor/list', function (Request $request)
{
	$token = $request->get('token');
	Log::info('request: '.print_r($request->all(),true) );

	if( $token != config('server-monitor.notifications.mattermost.slash_token') )
		throw new AccessDeniedHttpException();

	Artisan::call('server-monitor:list-checks', []);
	$text = Artisan::output();

	return response()->json([
		'response_type' => 'in_channel',
		'text' => $text ,
	]);
});

Route::post('/monitor/list', function (Request $request)
{
	$token = $request->get('token');
	//Log::info('request: '.print_r($request->all(),true) );

	/* [2017-11-12 09:34:27] production.INFO: request: Array
	(
		say: /the_command arg1 arg2
		response: 
		    [channel_id] => xyz123xyz123xyz123
		    [channel_name] => the channel name
		    [command] => /the_command
		    [response_url] => https://framateam.org/hooks/commands/xyz123xyz123xyz123
		    [team_domain] => the team
		    [team_id] => xyz123xyz123xyz123
		    [text] => arg1 arg2
		    [token] => abc123abc123
		    [user_id] => klm123klm123klm
		    [user_name] => user_name
	) */

	if( $token != config('uptime-monitor.notifications.mattermost.slash_token') )
		throw new AccessDeniedHttpException();

	try
	{
		$sub_command = trim( $request->get('text') );
		if( preg_match('#^help$#', $sub_command) )
		{
			Artisan::call('list', ['namespace'=>'monitor'] );
		}
		else if( preg_match('#^help#', $sub_command) )
		{
			Artisan::call('help', ['command_name'=>'monitor:'.$sub_command]);
		}
		else
		{
			Artisan::call('monitor:'.$sub_command, []);
		}

		$cmd_result = Artisan::output();

		$text = 'Uptime Monitor list at '
			. Carbon::now()->format('Y-m-d H:i:s')
			."\n".$cmd_result ;

	}
	catch (Exception $ex )
	{
		$text = 'An error occured: ' .get_class($ex). ' ' . $ex->getMessage() ;
	}

	return response()->json([
		'response_type' => 'in_channel',
		'text' => $text ,
	]);
});
