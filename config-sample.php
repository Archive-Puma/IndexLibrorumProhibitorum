<?php
    // Development
    define('DEBUG', false);
    // Database connection
    define('MYSQL_HOST', '<HOST>');
    define('MYSQL_USER', '<USER>');
    define('MYSQL_PASS', '<PASS>');
    define('MYSQL_DB', '<DATABASE>');
    define('MYSQL_TABLE', '<TABLE>');

    // Get the protocol and website
    $protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
    $website = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    if(substr($website, -1) !== '/') { $website = $website . '/'; }
    define('WEBSITE', $website);
?>