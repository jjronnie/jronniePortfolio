<?php

use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatHistoryController;
use App\Http\Controllers\ChatLeadController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.welcome');
})->name('home');

Route::view('/services', 'frontend.services')->name('services');
Route::view('/work', 'frontend.work')->name('work');
Route::view('/process', 'frontend.process')->name('process');
Route::view('/contact', 'frontend.contact')->name('contact');

Route::post('/chat', [ChatController::class, 'stream'])->name('chat.stream');
Route::post('/chat/lead', [ChatLeadController::class, 'store'])->name('chat.lead.store');
Route::get('/chat/lead/check', [ChatLeadController::class, 'check'])->name('chat.lead.check');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('knowledge', KnowledgeController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('chat-history', ChatHistoryController::class)->only(['index', 'show', 'destroy']);
    Route::get('/leads', [ChatLeadController::class, 'index'])->name('leads.index');
    Route::delete('/leads/{chatLead}', [ChatLeadController::class, 'destroy'])->name('leads.destroy');

    Route::get('/admin-chat', [AdminChatController::class, 'view'])->name('admin-chat');
    Route::post('/admin-chat', [AdminChatController::class, 'stream'])->name('admin-chat.stream');
});

require __DIR__.'/auth.php';
