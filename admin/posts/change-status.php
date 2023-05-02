<?php 
require_once '../../functions/connection.php';
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';
global $pdo;

if(isset($_GET['postID']) && $_GET['postID'] !=''){
    //check for exists post id
    $query = "SELECT * FROM `posts` WHERE id=?;";
    $statement = $pdo->prepare($query);
    $statement->execute([
    $_GET['postID']
    ]);
    $post= $statement->fetch();
    if($post !== false){
        $status=($post->status == 1)? 0 : 1;
        $query = "UPDATE `posts` SET status=? WHERE id=?;";
        $statement = $pdo->prepare($query);
        $statement->execute([
            $status, $_GET['postID']
        ]);
    } 
}
redirect('admin/posts');