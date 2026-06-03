User-agent: *
Allow: /

@foreach ($disallowPaths as $path)
Disallow: {{ $path }}
@endforeach

Sitemap: {{ $sitemap }}
