<?php 
session_start();
require_once '../functions/helpers.php';
require_once '../functions/connection.php';

global $pdo;

session_destroy();

redirect('auth/login.php');