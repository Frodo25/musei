<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home'); 
    }

    public function about()
    {
        return view('about', [
            'name' => 'Алишер', 
            'group' => '3ПОВТ24Б'
        ]); 
    }

    public function contacts()
    {
        return view('contacts'); 
    }

    public function rules()
    {
        return view('rules'); 
}}