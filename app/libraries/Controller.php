<?php

/*
 * Base Controller
 * Loads the models and views
 */

class Controller
{
    public function __construct()
    {
    }

    // Load model
    public function loadModel(string $model)
    {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate model
        return new $model();
    }

    // Load View
    public function loadView(string $view, array $data = [])
    {
        // Check for the view file
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else {
            // Views does not exist
            die('Views does not exist');
        }

    }
}