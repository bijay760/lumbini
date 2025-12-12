<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Property;
use App\Models\LandParcel;

class PageController extends Controller
{
    /**
     * Display the homepage
     */
    public function home(): View
    {
        $featuredProperties = Property::where('status', 'approved')
            ->latest()
            ->limit(6)
            ->get();

        $seoData = [
            'title' => 'Lumbani Innovate | Premier Real Estate Solutions in Nepal',
            'description' => 'Find your dream property in Nepal. Buy, sell, or rent residential and commercial properties with Nepal\'s most trusted real estate platform.',
            'keywords' => 'real estate Nepal, buy property Kathmandu, Nepal homes for sale, rent apartment Nepal, commercial property Nepal, Lumbani Innovate',
            'canonical' => url('/'),
            'og_title' => 'Lumbani Innovate - Transforming Real Estate in Nepal',
            'og_description' => 'Discover innovative property solutions with Nepal\'s leading real estate platform. Find homes, lands, and commercial spaces.',
            'og_type' => 'website'
        ];

        return view('home', compact('featuredProperties', 'seoData'));
    }

    /**
     * Display about us page
     */
    public function aboutUs(): View
    {
        $seoData = [
            'title' => 'About Lumbani Innovate | Leading Real Estate Company in Nepal',
            'description' => 'Learn about Lumbani Innovate\'s mission to transform Nepal\'s real estate industry. Over 5 years of trusted service in property buying, selling, and management.',
            'keywords' => 'about Lumbani Innovate, real estate company Nepal, property services Nepal, real estate expertise',
            'canonical' => url('/about-us'),
            'og_title' => 'About Lumbani Innovate - Your Trusted Real Estate Partner',
            'og_description' => 'Discover how Lumbani Innovate has been helping families find their perfect homes and investment properties across Nepal for over 5 years.'
        ];

        return view('about-us', compact('seoData'));
    }

    /**
     * Display projects/properties listing page
     */
    public function projects(): View
    {
        $properties = Property::where('status', 'approved')
            ->latest()
            ->paginate(12);

        $landParcels = LandParcel::where('is_approved', true)
            ->latest()
            ->paginate(12);

        $seoData = [
            'title' => 'Our Projects | Premium Properties & Land for Sale in Nepal',
            'description' => 'Explore our exclusive collection of residential properties, commercial spaces, and prime land plots across Nepal. Find your perfect investment opportunity today.',
            'keywords' => 'Nepal properties for sale, residential projects Nepal, commercial property Nepal, land for sale Kathmandu, real estate projects',
            'canonical' => url('/our-projects'),
            'og_title' => 'Premium Properties & Projects in Nepal - Lumbani Innovate',
            'og_description' => 'Browse through our carefully curated portfolio of properties and land projects across major cities in Nepal.'
        ];

        return view('projects', compact('properties', 'landParcels', 'seoData'));
    }

    /**
     * Display contact page
     */
    public function contact(): View
    {
        $seoData = [
            'title' => 'Contact Lumbani Innovate | Get Expert Real Estate Consultation',
            'description' => 'Contact our real estate experts for property buying, selling, or investment advice. Visit our office in Kathmandu or call us for immediate assistance.',
            'keywords' => 'contact Lumbani Innovate, real estate consultation Nepal, property advice Kathmandu, real estate office Nepal',
            'canonical' => url('/contact'),
            'og_title' => 'Contact Lumbani Innovate - Real Estate Experts in Nepal',
            'og_description' => 'Get in touch with our experienced real estate team for personalized property solutions across Nepal.'
        ];

        return view('contact', compact('seoData'));
    }

    /**
     * Display booking/property inquiry page
     */
    public function booking(): View
    {
        // Get approved properties for display
        $properties = DB::table('properties')
            ->leftJoin(DB::raw('
        (
            SELECT *
            FROM property_images AS pi1
            WHERE pi1.created_at = (
                SELECT MAX(pi2.created_at)
                FROM property_images AS pi2
                WHERE pi2.property_id = pi1.property_id
            )
        ) AS latest_images
    '), 'properties.id', '=', 'latest_images.property_id')
            ->where('properties.status', '=', 'approved')
            ->orderBy('properties.created_at', 'DESC')
            ->select('properties.*', 'latest_images.path')
            ->get();

        $seoData = [
            'title' => 'Book Property Consultation | Schedule Real Estate Services',
            'description' => 'Book a consultation with our real estate experts. Get personalized property recommendations and professional guidance for buying or selling in Nepal.',
            'keywords' => 'book property consultation Nepal, real estate booking, property services Nepal, schedule property viewing',
            'canonical' => url('/booking'),
            'og_title' => 'Book Your Property Consultation - Lumbani Innovate',
            'og_description' => 'Schedule a consultation with our real estate professionals and find the perfect property solution for your needs.'
        ];

        return view('booking', compact('properties', 'seoData'));
    }

    /**
     * Display land registration page
     */
    public function landRegister(): View
    {
        $seoData = [
            'title' => 'Land Registration Services | Property Documentation in Nepal',
            'description' => 'Professional land registration and property documentation services in Nepal. Ensure secure property ownership with our legal expertise.',
            'keywords' => 'land registration Nepal, property documentation, land ownership Nepal, real estate legal services, property registration',
            'canonical' => url('/land-register'),
            'og_title' => 'Land Registration & Documentation Services in Nepal',
            'og_description' => 'Secure your property investment with our comprehensive land registration and legal documentation services.'
        ];

        return view('land-register', compact('seoData'));
    }

    /**
     * Display blog/news page
     */
    public function blog(): View
    {
        $seoData = [
            'title' => 'Real Estate Blog | Property News & Market Insights Nepal',
            'description' => 'Stay updated with latest real estate news, market trends, and property investment tips in Nepal. Expert insights from Lumbani Innovate professionals.',
            'keywords' => 'real estate blog Nepal, property news Nepal, real estate market trends, property investment tips, Nepal property insights',
            'canonical' => url('/blog'),
            'og_title' => 'Real Estate Blog & News - Lumbani Innovate',
            'og_description' => 'Get expert insights on Nepal\'s real estate market, property investment strategies, and latest industry news.'
        ];

        return view('blog', compact('seoData'));
    }

    /**
     * Display services page
     */
    public function services(): View
    {
        $seoData = [
            'title' => 'Real Estate Services | Property Management & Consulting Nepal',
            'description' => 'Comprehensive real estate services including property buying, selling, renting, management, and investment consulting in Nepal.',
            'keywords' => 'real estate services Nepal, property management Nepal, real estate consulting, property buying selling services',
            'canonical' => url('/services'),
            'og_title' => 'Professional Real Estate Services in Nepal',
            'og_description' => 'Complete range of professional real estate services to meet all your property needs in Nepal.'
        ];

        return view('services', compact('seoData'));
    }

    /**
     * Display properties for sale page
     */
    public function propertiesForSale(): View
    {
        $properties = Property::where('status', 'approved')
            ->latest()
            ->paginate(15);

        $seoData = [
            'title' => 'Properties for Sale in Nepal | Houses, Apartments & Land',
            'description' => 'Browse premium properties for sale across Nepal. Find houses, apartments, commercial spaces, and land plots in Kathmandu, Pokhara, and other major cities.',
            'keywords' => 'properties for sale Nepal, houses for sale Kathmandu, apartments for sale Nepal, land for sale Nepal, buy property Nepal',
            'canonical' => url('/properties-for-sale'),
            'og_title' => 'Premium Properties for Sale in Nepal - Lumbani Innovate',
            'og_description' => 'Discover your dream property from our extensive collection of homes, apartments, and land for sale across Nepal.'
        ];

        return view('properties-for-sale', compact('properties', 'seoData'));
    }

    /**
     * Display properties for rent page
     */
    public function propertiesForRent(): View
    {
        $properties = Property::where('status', 'approved')
            ->latest()
            ->paginate(15);

        $seoData = [
            'title' => 'Properties for Rent in Nepal | Apartments & Houses for Rent',
            'description' => 'Find quality rental properties in Nepal. Browse apartments, houses, and commercial spaces for rent in Kathmandu, Pokhara, and other prime locations.',
            'keywords' => 'properties for rent Nepal, apartments for rent Kathmandu, houses for rent Nepal, rental properties Nepal',
            'canonical' => url('/properties-for-rent'),
            'og_title' => 'Quality Properties for Rent in Nepal - Lumbani Innovate',
            'og_description' => 'Find your ideal rental property from our verified collection of apartments and houses across Nepal.'
        ];

        return view('properties-for-rent', compact('properties', 'seoData'));
    }

    /**
     * Display investment opportunities page
     */
    public function investments(): View
    {
        $seoData = [
            'title' => 'Real Estate Investment Opportunities in Nepal | Property Investment',
            'description' => 'Discover lucrative real estate investment opportunities in Nepal. Commercial properties, residential projects, and land development opportunities.',
            'keywords' => 'real estate investment Nepal, property investment opportunities, commercial property investment Nepal, land investment',
            'canonical' => url('/investment-opportunities'),
            'og_title' => 'Profitable Real Estate Investment Opportunities in Nepal',
            'og_description' => 'Explore high-return real estate investment opportunities across Nepal with expert guidance from Lumbani Innovate.'
        ];

        return view('investments', compact('seoData'));
    }
}
