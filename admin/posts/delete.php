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
        $basePath=dirname(dirname(__DIR__));
        if(file_exists($basePath.$post->image)){
            unlink($basePath.$post->image);
        }
        
        $query = "DELETE FROM `posts` WHERE id=?;";
        $statement = $pdo->prepare($query);
        $statement->execute([
           $_GET['postID']
        ]);
       
    } 
}
redirect('admin/posts');