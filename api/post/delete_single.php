<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    include_once '../../config/Database.php';
    include_once '../../models/BlogPosts.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate 'blog post' object
    $post = new Post($db);

    // get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update id
    $post->id= $data->id;

    // Update blog post
    if($post->delete_single()) {
        echo json_encode(
            array('message' => 'Post deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not deleted')
        );
    }
?>