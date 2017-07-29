<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function getIndex(){
		return view("front.$this->frontendNumber.pages.index");
    }

    public function getContactUs(){
    	return view("front.$this->frontendNumber.pages.contact-us");
    }

    public function getAboutUs(){
    	return view("front.$this->frontendNumber.pages.about-us");
    }
}
