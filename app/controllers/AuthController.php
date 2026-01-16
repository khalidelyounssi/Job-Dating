<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Validator;
use App\Core\Session;
use App\Core\Security;

class AuthController extends Controller {

    public function register() {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Erreur de sécurité : Token CSRF invalide.");
            }

            $data = Security::safe($_POST);
            
            $userModel = new User();
            $validator = new Validator();

            $rules = [
                'username' => 'required|min:3',
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:8'
            ];

            if ($validator->validate($data, $rules)) {
                
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
                unset($data['confirm_password']);
                unset($data['csrf_token']);

                if ($userModel->create($data)) {
                    Session::setFlash('Inscription réussie ! Connectez-vous.');
                    header('Location: /login');
                    exit;
                }
            } else {
                $errors = $validator->getErrors();
            }
        }

        $this->view('auth/register', ['errors' => $errors]);
    }

    public function login() {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!Security::verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die("Erreur de sécurité : Token CSRF invalide.");
            }

            $data = Security::safe($_POST);
            $userModel = new User();
            
            $users = $userModel->where('email', $data['email']);
            $user = $users[0] ?? null;

            if ($user && password_verify($data['password'], $user['password'])) {
                
                Session::set('user_id', $user['id']);
                Session::set('username', $user['username']);
                Session::set('role', $user['role'] ?? 'user');

                header('Location: /');
                exit;

            } else {
                $errors['login'] = ['Email ou mot de passe incorrect.'];
            }
        }

        $this->view('auth/login', ['errors' => $errors]);
    }

    public function logout() {
        Session::destroy();
        header('Location: /login');
        exit;
    }
}