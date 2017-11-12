<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Support\Facades\Log;

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
	Log::info('token: '.$token );

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
	Log::info('token: '.$token );
	
	if( $token != config('server-monitor.notifications.mattermost.slash_token') )
		throw new AccessDeniedHttpException();
		
	Artisan::call('monitor:list', []);
	$text = Artisan::output();

	return response()->json([
		'response_type' => 'in_channel',
		'text' => $text ,
	]);
});
