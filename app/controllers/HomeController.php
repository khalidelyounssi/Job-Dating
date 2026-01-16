<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth; 

class HomeController extends Controller {

    public function index() {
        Auth::requireLogin();

        $this->view('home');
    }
}