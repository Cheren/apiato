<?php

use Illuminate\Support\Facades\Route;
use App\Containers\AppSection\Authentication\UI\WEB\Controllers\Controller;

Route::post('/logout', [Controller::class, 'logout'])
    ->name('post_logout');
