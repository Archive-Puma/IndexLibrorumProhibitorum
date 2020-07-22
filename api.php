<?php
    // Global configuration
    require('config.php');
    // Enable debug messages
    if(DEBUG) { error_reporting(E_ALL); ini_set('display_errors', 1); }

    // Response headers
    header('Content-Type: application/json');
    header('X-Powered-By: Index Librorum Prohibitorum');

    // Connect to the database
    $mysql = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
    ($mysql && !$mysql->connect_error)
        or die(json_encode(['what' => 'Touma!']));

    // [[ Shortener ]]
    if (isset($_POST['short']) && isset($_POST['url']) && $_POST['url']) {
        // Get the data
        $long = $_POST['url'];
        if(substr($long, -1) !== '/') { $long = $long . '/'; }
        // Check URL syntax
        (filter_var($long, FILTER_VALIDATE_URL) && preg_match("/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/", $long))
            or die(json_encode(['error' => 'Not a valid URL.']));
        // Calculate the short alias 
        $short = substr(md5($long), 1, 6);
        // Prepare the SQL statement to avoid SQLi
        $stmt = $mysql->prepare("INSERT INTO " . MYSQL_TABLE . " (shorturl, longurl) VALUES (?, ?)");
        $stmt or die(json_encode(['what' => 'Imagine Breaker!']));
        // Execute SQL statement
        $stmt->bind_param('ss', $short, $long);
        $stmt->execute();
        // Return the values
        echo(json_encode(['url' => $long, 'link' => WEBSITE . $short]));
    // [[ Redirect ]]
    } else if (isset($_POST['index']) && $_POST['index'] && preg_match('/([a-f0-9]{6})/', $_POST['index'])) {
        // Prepare the SQL statement to avoid SQLi
        $stmt = $mysql->prepare("SELECT longurl FROM " . MYSQL_TABLE . " WHERE shorturl = ? LIMIT 1");
        $stmt or die(json_encode(['what' => 'Sphinx!']));
        $stmt->bind_param('s', $_POST['index']);
        $stmt->execute();
        echo(json_encode((($result = $stmt->get_result()) && ($result = $result->fetch_assoc()) && isset($result['longurl']))
            ? [ 'url' => $result['longurl'], 'link' => WEBSITE . $_POST['index'] ]
            : ['error' => 'Not a valid link.']
        ));
    // [[ Something went wrong ]]
    } else {
        header("HTTP/1.1 400 Bad Request");
        die(json_encode(['what' => '103.000 books']));
    }

    // Close the connection
    $stmt->close();
    $mysql->close();
?>