<?php

namespace App\Http\Controllers;


use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::latest()->take(10)->get();
        return view('index', compact('links'));
    }

    public function shorten(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        $link = new Link();
        $link->original_url = $request->input('original_url');
        $link->shortened_code = $this->generateShortCode();
        $link->save();

        return response()->json([
            'shortened_url' => route('redirect', $link->shortened_code)
        ]);
    }

    public function redirect($code)
    {
        $link = Link::where('shortened_code', $code)->firstOrFail();

        return redirect($link->original_url);
    }

    private function generateShortCode()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return base64_encode($randomString);
    }

    public function shortenedlinks()
    {
        $links = Link::latest()->take(10)->get();
        return view('shortened-links', compact('links'));
    }
}
