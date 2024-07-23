<?php

namespace App\Http\Controllers;

use App\Models\Donwload;

class DonwloadController extends Controller
{
    public function index()
    {
        $downloads = Donwload::query()->get();

        return view('link', ['downloads' => $downloads]);
    }
}
