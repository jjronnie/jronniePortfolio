<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Services\SeoService;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function __construct(protected SeoService $seo) {}

    public function welcome(): View
    {
        $coreServices = Service::active()->where('type', 'core')->ordered()->get();

        $featuredProjects = Project::active()->featured()->ordered()->get();

        $skillsByCategory = Skill::active()->ordered()->get()->groupBy('category');

        $workExperiences = Experience::active()->where('type', 'work')->ordered()->get();

        $educationExperiences = Experience::active()->where('type', 'education')->ordered()->get();

        $testimonials = Testimonial::active()->ordered()->get();

        $seoData = $this->seo->homeSeoData();

        return view('frontend.welcome', compact(
            'coreServices',
            'featuredProjects',
            'skillsByCategory',
            'workExperiences',
            'educationExperiences',
            'testimonials',
            'seoData',
        ));
    }

    public function services(): View
    {
        $coreServices = Service::active()->where('type', 'core')->ordered()->get();

        $beyondServices = Service::active()->where('type', 'beyond')->ordered()->get();

        $seoData = $this->seo->servicesSeoData();

        return view('frontend.services', compact('coreServices', 'beyondServices', 'seoData'));
    }

    public function projects(): View
    {
        $featuredProjects = Project::active()->featured()->ordered()->get();

        $otherProjects = Project::active()->where('is_featured', false)->ordered()->get();

        $seoData = $this->seo->projectsSeoData();

        return view('frontend.projects', compact('featuredProjects', 'otherProjects', 'seoData'));
    }

    public function contact(): View
    {
        $seoData = $this->seo->contactSeoData();

        return view('frontend.contact', compact('seoData'));
    }

    public function serviceShow(string $slug): View
    {
        $service = Service::active()->where('slug', $slug)->firstOrFail();

        $related = Service::active()
            ->where('id', '!=', $service->id)
            ->where('type', $service->type)
            ->ordered()
            ->limit(4)
            ->get();

        $seoData = $this->seo->singleServiceSeoData($service);

        return view('frontend.service-show', compact('service', 'related', 'seoData'));
    }

    public function projectShow(string $slug): View
    {
        $project = Project::active()->where('slug', $slug)->firstOrFail();

        $related = Project::active()
            ->where('id', '!=', $project->id)
            ->where('category', $project->category)
            ->ordered()
            ->limit(4)
            ->get();

        $seoData = $this->seo->singleProjectSeoData($project);

        return view('frontend.project-show', compact('project', 'related', 'seoData'));
    }
}
