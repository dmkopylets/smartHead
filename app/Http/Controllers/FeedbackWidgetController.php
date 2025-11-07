<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackWidgetController extends Controller
{
    public function index()
    {
        return view('feedback-widget');
    }
}
