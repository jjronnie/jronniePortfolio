<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0))
            ->add(Url::create('/about')
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.8))
            ->add(Url::create('/blog')
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.9))
            ->add(Url::create('/services')
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.8))
            ->add(Url::create('/projects')
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.7));

        Post::published()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog.show', $post->slug))
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            );
        });

        PostCategory::whereHas('publishedPosts')->each(function (PostCategory $category) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog.category', $category->slug))
                    ->setLastModificationDate($category->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.5)
            );
        });

        Service::active()->each(function (Service $service) use ($sitemap) {
            $sitemap->add(
                Url::create(route('service.show', $service->slug))
                    ->setLastModificationDate($service->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            );
        });

        Project::active()->each(function (Project $project) use ($sitemap) {
            $sitemap->add(
                Url::create(route('project.show', $project->slug))
                    ->setLastModificationDate($project->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            );
        });

        return $sitemap->toResponse(request());
    }
}
