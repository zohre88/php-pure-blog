<?php
session_start();

if(!isset($_SESSION['is_login'])){
    redirect('auth/login.php');
}