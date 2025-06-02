<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
//use App\Models\Property;

class SitemapController extends Controller
{
    public function index(): Response
    {

        $lastMod = Carbon::now()->format('Y-m-d');

        return response()
            ->view('sitemap.index', compact( 'lastMod'))
            ->header('Content-Type', 'text/xml');
    }
}
