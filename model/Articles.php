<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function createArticle($text, $image) {
    if ($text == null && $image == null) {
        return 'error, must have text or image';
    }
}