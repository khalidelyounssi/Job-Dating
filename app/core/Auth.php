<?php
namespace App\Core;

use App\Core\Session;

class Auth {

    public static function check() {
        return Session::get('user_id') !== null;
    }

    public static function user() {
        if (self::check()) {
            return [
                'id' => Session::get('user_id'),
                'username' => Session::get('username'),
                'role' => Session::get('role')
            ];
        }
        return null;
    }

    public static function requireLogin() {
        if (!self::check()) {
            Session::setFlash('Vous devez être connecté pour accéder à cette page.');
            header('Location: /login');
            exit;
        }
    }
    
    public static function requireAdmin() {
        self::requireLogin(); 
        
        if (Session::get('role') !== 'admin') {
            header('Location: /'); 
            exit;
        }
    }
}