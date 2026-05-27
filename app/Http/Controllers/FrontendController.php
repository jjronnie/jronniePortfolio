<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function welcome(): View
    {
        $coreServices = Service::active()->where('type', 'core')->ordered()->get();

        $featuredProjects = Project::active()->featured()->ordered()->get();

        $skillsByCategory = Skill::active()->ordered()->get()->groupBy('category');

        $workExperiences = Experience::active()->where('type', 'work')->ordered()->get();

        $educationExperiences = Experience::active()->where('type', 'education')->ordered()->get();

        return view('frontend.welcome', compact(
            'coreServices',
            'featuredProjects',
            'skillsByCategory',
            'workExperiences',
            'educationExperiences',
        ));
    }

    public function services(): View
    {
        $coreServices = Service::active()->where('type', 'core')->ordered()->get();

        $beyondServices = Service::active()->where('type', 'beyond')->ordered()->get();

        return view('frontend.services', compact('coreServices', 'beyondServices'));
    }

    public function projects(): View
    {
        $featuredProjects = Project::active()->featured()->ordered()->get();

        $otherProjects = Project::active()->where('is_featured', false)->ordered()->get();

        return view('frontend.projects', compact('featuredProjects', 'otherProjects'));
    }
}
