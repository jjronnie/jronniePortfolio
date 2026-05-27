<?php

use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatHistoryController;
use App\Http\Controllers\ChatLeadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\ProfileController;
use App\Models\ChatLead;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'welcome'])->name('home');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/projects', [FrontendController::class, 'projects'])->name('projects');

Route::redirect('/work', '/projects');
Route::get('/process', fn () => redirect('/'));
Route::get('/contact', fn () => redirect('/#contact'));

Route::post('/chat', [ChatController::class, 'stream'])->name('chat.stream');
Route::post('/chat/lead', [ChatLeadController::class, 'store'])->name('chat.lead.store');
Route::get('/chat/lead/check', [ChatLeadController::class, 'check'])->name('chat.lead.check');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', function () {
    $stats = [
        'services' => Service::count(),
        'projects' => Project::count(),
        'skills' => Skill::count(),
        'contacts' => Contact::count(),
        'leads' => ChatLead::count(),
        'servicesByType' => Service::selectRaw('type, count(*) as count')->groupBy('type')->pluck('count', 'type'),
        'projectsByCategory' => Project::selectRaw('category, count(*) as count')->groupBy('category')->pluck('count', 'category'),
        'contactsByMonth' => Contact::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, count(*) as count")->groupBy('month')->orderBy('month')->pluck('count', 'month'),
    ];

    return view('dashboard', compact('stats'));
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

    Route::prefix('admin')->name('admin.')->middleware('verified')->group(function () {
        Route::resource('services', AdminServiceController::class);
        Route::resource('projects', AdminProjectController::class);
        Route::resource('skills', AdminSkillController::class);
        Route::resource('experiences', AdminExperienceController::class);
    });
});

require __DIR__.'/auth.php';
