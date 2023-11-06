<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenre;

class JenreController extends Controller
{
    public function index(Jenre $jenre)
    {
        return view('jenres.index')->with(['events' => $jenre->getByJenre()]);
    }
}
