<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('toto', function ()
{
	//$this->comment(Inspiring::quote());
	//$this->call( 'list', ['namespace'=>'monitor'] );
	
	$sub_command= 'list' ;
	$this->call('help', ['command_name'=>'monitor:'.$sub_command]);

})->describe('Try some stuff');
