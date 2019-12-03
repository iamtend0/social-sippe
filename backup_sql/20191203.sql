/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  apuget29
 * Created: 3 déc. 2019
 */

CREATE TABLE users (
    id_user INT(10) PRIMARY KEY NOT NULL,
    email VARCHAR(255) NOT NULL,
    nom VARCHAR(200) NOT NULL,
    prenom VARCHAR(200) NOT NULL,
);

CREATE TABLE articles (
    id_article INT(10) PRIMARY KEY NOT NULL,
    link_img VARCHAR(255),
);