<img src=".github/readme/logo.png" align="right" width="250">

# Index Librorum Prohibitorum

[![License](https://img.shields.io/github/license/cosasdepuma/IndexLibrorumProhibitorum?style=for-the-badge&color=important)](https://github.com/CosasDePuma/IndexLibrorumProhibitorum/blob/master/LICENSE)
[![Web Preview](https://img.shields.io/static/v1?label=&message=PREVIEW&color=939EBE&style=for-the-badge)](http://index.kike.wtf/)
[![What's the reference](https://img.shields.io/static/v1?label=&message=WHAT\'S%20THE%20REFERENCE&color=EED34C&style=for-the-badge)](https://toarumajutsunoindex.fandom.com/wiki/Index_Librorum_Prohibitorum)

***Index Librorum Prohibitorum*** (or ***Index***) is a URL shortener/masker. The URL identifier is only 6 digits long.

🖥️ Installation
---
This website requires some software to work correctly:

- [x] PHP 7.2
- [x] Apache2
- [x] MySQL

> PHP requires `curl` extension to be installed.

> Other software like `nginx` or alternative `PHP` versions may cause an unexpected behaviour. 

🔩 Configuration
---
`config.php` contains all the information relative to the MySQL configuration. You should replace the following lines with the right values:

```php
// Database connection
define('MYSQL_HOST', '<HOST>');
define('MYSQL_USER', '<USER>');
define('MYSQL_PASS', '<PASS>');
define('MYSQL_DB', '<DATABASE>');
define('MYSQL_TABLE', '<TABLE>');
```

You can also enable the **debug mode** to get reports from notices and warnings.

🐙 Support the developer!
----
Everything I do and publish can be used for free whenever I receive my corresponding merit.

Anyway, if you want to help me in a more direct way, you can leave me a tip by clicking on this badge:

<p align="center">
    </br>
    <a href="https://www.paypal.me/cosasdepuma/"><img src="https://img.shields.io/badge/Donate-PayPal-blue.svg?style=for-the-badge" alt="PayPal Donation"></a>
</p>
 
