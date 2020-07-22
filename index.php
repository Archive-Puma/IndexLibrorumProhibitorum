<?php
    // Global configuration
    require('config.php');
    // Enable debug messages
    if(DEBUG) { error_reporting(E_ALL); ini_set('display_errors', 1); }

    // Response headers
    header('X-Powered-By: Index Librorum Prohibitorum');

    /**
     * API POST Request.
     *
     * @since 1.0
     * @author  Kike Fontán (@CosasDePuma)
     * @param array $data POST fields.
     * @return $response API body response.
     */
    function api($data) {
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL, WEBSITE . 'api.php');
        curl_setopt($client, CURLOPT_HEADER, 0);
        curl_setopt($client, CURLOPT_POST, 1);
        curl_setopt($client, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($client);
        curl_close($client);
        return $response ? json_decode($response, true) : array();
    }

    // URL redirection
    if(isset($_GET['index']) && $_GET['index'] && preg_match('/[a-f0-9]{6}/', $_GET['index'])) {
        $data = [ 'index' => $_GET['index'] ];
        $response = api($data);
        // Redirections
        $location = (isset($response) && isset($response['url']) && $response['url'])
            ? $response['url']
            : WEBSITE;
        header('Location: ' . $location);
        exit(0);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="root">
        <form method="POST" action="<?=basename(__FILE__)?>">
            <input type="text" name="url" placeholder="Enter your URL" />
            <input type="submit" name="short" value="Touma!" />
        </form>
<?php
    // Show short URL
    if(isset($_POST) && isset($_POST['short']) && isset($_POST['url']) && $_POST['url']) {
        $data = api($_POST);
        if(isset($data['link']) && $data['link']) {
            echo('<p><b>Your URL is: <a href="' . $data['link'] . '">' . $data['link'] . '</a></b></p>');
        }
    }
?>
    </div>
</body>
</html>