<?php

use Illuminate\Support\Facades\Route;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\Controller;

Route::post('login', [Controller::class, 'login'])
    ->name('login_post_form');
