<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->loadModel('User');
    }

    public function register()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];

            // Validate fields
            if (empty($data['name'])) {
                $data['name_error'] = 'Name is required!';
            }

            if (empty($data['email'])) {
                $data['email_error'] = 'Email is required!';
            } else {
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_error'] = 'Email is already taken';
                }
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Password is required!';
            } else if (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Confirm password is required!';
            } else if ($data['password'] !== $data['confirm_password']) {
                $data['confirm_password_error'] = 'Passwords do not match';
            }

            // Make sure there are no errors
            if (empty($data['email_error']) && empty($data['name_error']) &&
                empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if( $this->userModel->register($data)){
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->loadView('users/register', $data);
            }

        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];

            // Load view
            $this->loadView('users/register', $data);
        }
    }


    public function login()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => ''
            ];

            // Validate fields
            if (empty($data['email'])) {
                $data['email_error'] = 'Email is required!';
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Password is required!';
            } else if (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            // Make sure there are no errors
            if (empty($data['email_error']) && empty($data['password_error'])) {
                // Validated
                die('SUCCESS');
            } else {
                // Load view with errors
                $this->loadView('users/login', $data);
            }


        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => ''
            ];

            // Load view
            $this->loadView('users/login', $data);
        }
    }
}