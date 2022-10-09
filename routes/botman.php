<?php
use App\Http\Controllers\BotManController;
use App\Conversations\SelectServiceConversation;

$botman = resolve('botman');

$botman->hears('hi|', BotManController::class.'@startConversation');


