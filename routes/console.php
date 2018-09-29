<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

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
    $comment = $this->comment(Inspiring::quote());
    Log::info($comment);
})->describe('Display an inspiring quote');

Artisan::command('myCommand', function (){
    Log::info('Se ejecutó mi comando creado.');
})->describe('My command created by me :)');
