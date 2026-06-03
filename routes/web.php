<?php

use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\PostCategoryController as AdminPostCategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatHistoryController;
use App\Http\Controllers\ChatLeadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\LlmsTxtController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use App\Models\ChatLead;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'welcome'])->name('home');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/services/{slug}', [FrontendController::class, 'serviceShow'])->name('service.show');
Route::get('/projects', [FrontendController::class, 'projects'])->name('projects');
Route::get('/projects/{slug}', [FrontendController::class, 'projectShow'])->name('project.show');

Route::redirect('/work', '/projects');
Route::get('/process', fn () => redirect('/'));
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{slug}', [BlogController::class, 'tag'])->name('blog.tag');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap.xml');
Route::get('/robots.txt', RobotsController::class)->name('robots.txt');
Route::get('/llms.txt', LlmsTxtController::class)->name('llms.txt');

Route::feeds();

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
        'posts' => Post::count(),
        'publishedPosts' => Post::where('status', 'published')->count(),
        'experiences' => Experience::count(),
        'testimonials' => Testimonial::count(),
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
        Route::resource('posts', AdminPostController::class)->parameters(['posts' => 'post']);
        Route::post('posts/{post}/featured-image', [AdminPostController::class, 'uploadFeaturedImage'])->name('posts.featured-image');
        Route::resource('post-categories', AdminPostCategoryController::class);
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
        Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
    });
});

require __DIR__.'/auth.php';
