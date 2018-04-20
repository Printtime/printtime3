<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($pages as $item)
     <url>
        <loc>https://printtime.com.ua/{{ $item->slug }}</loc>
      	<changefreq>{{ $item->changefreq }}</changefreq>
      	<priority>{{ $item->priority }}</priority>
        <lastmod>{{ $item->updated_at->toAtomString() }}</lastmod>
     </url>
    @endforeach
</urlset>