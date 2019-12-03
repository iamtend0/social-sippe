<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppController
 *
 * @author apuget29
 */

    
if ( !isset($_GET['page']) ) {
   require '../view/home.php'; 
   exit();
}

switch($_GET['page']) {
    case 'new-article':
    break;
    case 'home':
        require '../view/home.php'; 
        break;
    case 'comment':
        require '../view/home.php';
        break;
    default:
        require '../view/home.php';
}
    
   

