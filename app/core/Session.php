<?php
namespace App\Core;

class Session {

    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function remove($key) {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() {
        self::start();
        session_destroy();
        $_SESSION = [];
    }

    public static function setFlash($message) {
        self::set('flash_message', $message);
    }

    public static function getFlash() {
        $message = self::get('flash_message');
        self::remove('flash_message');
        return $message;
    }
}