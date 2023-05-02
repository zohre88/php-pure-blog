<?php 

require_once '../../functions/connection.php';
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';

if(isset($_GET['categoryID'] ) && $_GET['categoryID']!=='' ){
    global $pdo;
    $query= "DELETE FROM `categories` WHERE id=?";
    $statement=$pdo->prepare($query);
    $statement->execute([
        $_GET['categoryID']
    ]);
}
    redirect('admin/categories');
