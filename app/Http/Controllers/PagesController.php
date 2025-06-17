<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function showDtn()
    {
        return view('layouts.dtn');
    }

    public function showWJJC()
    {
        return view('layouts.wjjc');
    }

    public function showAssociation()
    {
        return view('layouts.association');
    }

    public function showAffiliations()
    {
        return view('layouts.affiliations');
    }

    public function showSponsors()
    {
        return view('layouts.partnerships');
    }



    public function showWjjcGallery()
    {
        return view('layouts.wjjcgallery');
    }

    public function showWJJCPT()
    {
        return view('layouts.wjjcportugal');
    }

    public function showKishido()
    {
        return view('layouts.kishido');
    }

    public function showGallery()
    {
        return view('layouts.gallery');
    }

    public function showFounder()
    {
        return view('layouts.founder');
    }

    public function showWorkout()
    {
        return view('layouts.workout');
    }
    public function showEvents()
    {
        return view('layouts.events');
    }

    public function showForm()
    {
        return view('layouts.contact');
    }

    public function showDojos()
    {
        return view('layouts.dojos');
    }

    public function showCertification()
    {
        return view('layouts.certification');
    }

    public function showLogo()
    {
        return view('layouts.logo');
    }
}
