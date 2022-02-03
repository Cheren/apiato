<?php

use Illuminate\Support\Facades\Route;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\Controller;

Route::get('login', [Controller::class, 'showLoginPage'])
    ->name('login')
    ->middleware(['guest']);
