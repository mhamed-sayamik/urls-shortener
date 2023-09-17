<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $longUrl = $request->input('url');
        $shortUrl = $this->generateShortUrl();

        Url::create([
            'short_url' => $shortUrl,
            'long_url' => $longUrl,
        ]);

        return response()->json([
            'short_url' => $shortUrl,
        ]);
    }

    public function show($shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->first();

        if (!$url) {
            return response()->json([
                'error' => 'This short url does not exist',
            ], 404);
        }

        $url->increment('click_count');
        return response()->json([
            'long_url' => $url->long_url,
        ]);
    }

    public function index()
    {
        $urls = Url::orderBy('created_at', 'desc')->get();

        return response()->json($urls);
    }

    public function mostVisited()
    {
        $mostVisitedUrls = Url::orderBy('click_count', 'desc')->get();

        return response()->json($mostVisitedUrls);
    }

    private function generateShortUrl()
    {
        do {//generate random url and repeate if its already existing
            $shortUrl = Str::random(16);
        } while (Url::where('short_url', $shortUrl)->exists());

        return $shortUrl;
    }
}
