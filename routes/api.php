<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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

Route::get('/server-monitor/list', function (Request $request)
{
	$token = $request->get('token');
	if( $token != config('server-monitor.notifications.mattermost.slash_token') )
		throw new AccessDeniedHttpException();

	return response()->json([
		'response_type' => 'in_channel',
		'text' => 'Yep!' ,
	]);
});
