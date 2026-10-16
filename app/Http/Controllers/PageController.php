<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home'); // Убрали 'pages.'
    }

    public function about()
    {
        return view('about', [
            'name' => 'Алишер', 
            'group' => '3ПОВТ24Б'
        ]); // Убрали 'pages.'
    }

    public function contacts()
    {
        return view('contacts'); // Убрали 'pages.'
    }

    public function rules()
    {
        return view('rules'); // Убрали 'pages.'
    }
}