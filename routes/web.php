<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/tasks', \App\Livewire\TaskManager::class)->name('tasks');

