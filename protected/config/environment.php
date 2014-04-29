<?php

/**
 * Put environment specific config
 */

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'default'));
$dbName = 'stereotribes';
$dbUser = 'root';
$dbPassword = 'password';

if(APPLICATION_ENV == 'jump-dev') {
       $dbName = 'stereotribes';
       $dbUser = 'root';
       $dbPassword = 'password';


       $fbAppId = '231266650409136';
       $fbSecret = 'f6aefdeb97323090980fc2f4e98bcf1a';
} else if (APPLICATION_ENV == 'sreenadh') {
       $dbName = 'stereotribes';
       $dbUser = 'root';
       $dbPassword = 'mysql';
}

