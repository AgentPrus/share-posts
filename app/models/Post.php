<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query('SELECT *,
                                posts.id as postId,
                                users.id as userId,
                                posts.created_at as postCreated,
                                users.created_at as usesrCreated
                                FROM posts
                                INNER JOIN users
                                ON posts.user_id = users.id
                                ORDER BY posts.created_at DESC');

        return $this->db->resultSet();
    }

    public function getPostById(int $id)
    {
        $this->db->query('SELECT * FROM posts where id = :id');
        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function addPost(array $data)
    {
        $this->db->query('INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :user_id)');

        $this->db->bind('title', $data['title']);
        $this->db->bind('body', $data['body']);
        $this->db->bind('user_id', $data['user_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');

        $this->db->bind('title', $data['title']);
        $this->db->bind('body', $data['body']);
        $this->db->bind('id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts where id = :id');
        $this->db->bind('id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}