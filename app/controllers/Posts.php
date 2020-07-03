<?php

class Posts extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->loadModel('Post');
        $this->userModel = $this->loadModel('User');
    }

    public function index()
    {
        // Get posts
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->loadView('posts/index', $data);
    }

    public function show($id)
    {
        // Get single post
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->loadView('posts/show', $data);
    }


    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body';
            }

            // Make sure no errors
            if (!empty($data['title_err']) && !empty($data['body_err'])) {
                // Load view with errors
                $this->loadView('posts/add', $data);
            } else {
                // Create new post
                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Post added');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            }
        } else {
            $data = [
                'title' => '',
                'body' => ''
            ];
            $this->loadView('posts/add');
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // Validate data
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body';
            }

            // Make sure no errors
            if (!empty($data['title_err']) && !empty($data['body_err'])) {
                // Load view with errors
                $this->loadView('posts/edit', $data);
            } else {
                // Create new post
                if ($this->postModel->updatePost($data)) {
                    flash('post_message', 'Post updated');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            }


        } else {
            $post = $this->postModel->getPostById($id);

            // Check for owner
            if ($post->user_id !== $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];

            $this->loadView('posts/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $this->postModel->getPostById($id);

            // Check for owner
            if ($post->user_id !== $_SESSION['user_id']) {
                redirect('posts');
            };

            if ($this->postModel->deletePost($id)) {
                flash('post_message', 'Post successfully has been deleted');
                redirect('posts');
            } else {
                die('Something went wrong');
            }

        } else {
            redirect('posts');
        }
    }

}