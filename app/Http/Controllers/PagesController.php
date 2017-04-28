<?php

namespace App\Http\Controllers;

use App\Repositories\DetailRepository;

class PagesController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function randomDetail(DetailRepository $repository)
    {
        return $repository->getRandomDetail();
    }
}
