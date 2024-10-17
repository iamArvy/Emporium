<?php

namespace App\Http\Controllers\Emporium;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmporiumController extends Controller
{
    //
    public function index()
    {
        return $this->render('Emporium/Home');
    }
}
