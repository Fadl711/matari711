<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Section;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $sections = Section::all();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $xml .= '<url>';
        $xml .= '<loc>' . url('/') . '</loc>';
        $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
        $xml .= '<changefreq>daily</changefreq>';
        $xml .= '<priority>1.0</priority>';
        $xml .= '</url>';

        // About page
        $xml .= '<url>';
        $xml .= '<loc>' . route('about') . '</loc>';
        $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
        $xml .= '<changefreq>monthly</changefreq>';
        $xml .= '<priority>0.8</priority>';
        $xml .= '</url>';

        // Sections
        foreach ($sections as $section) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('posts.section', $section->id) . '</loc>';
            $xml .= '<lastmod>' . $section->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        // Posts
        foreach ($posts as $post) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('posts.show', $post->id) . '</loc>';
            $xml .= '<lastmod>' . $post->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>0.6</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
