<?php
$BASE_URL = 'http://localhost:8000';
include 'database.php';
include 'utils.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <title>Document</title>
</head>
<body>
    <h1>Link Extender</h1>
    <form action="/index.php" method="post" class="form">
    <label><input id="fname" type="text" name="url", placeholder="URL"><br></label>
    <input type="submit" class="login" value="Submit">
    </form>
    <div class="php-response">
    <?php 
    $url = $_SERVER['REQUEST_URI'];
    $db = new DB_Connection();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['url'])) {
            die("Missing required params: url");
        }
        if (!check_url($_POST['url']) || strlen($_POST['url']) > 255) {
            die("Invalid url");
        }
        do {
            $path = generate_ipsum();
            if ($path === FALSE) {
                die("Failed to generate ipsum");
            }
        } while ($db->exists_path($path));
        $md5_path = md5($path);
        // if ($db->exists($_POST['url'])) {
        //     $res = $db->query_path($_POST['url']);
        //     die("<a href='".$BASE_URL . "/a/" . $res ."'>" . $BASE_URL . "/a/" . $res . "</a>");
        // }
        if ($db->insert($_POST['url'], $md5_path)) {
            die("<a href='".$BASE_URL . "/a/" . $path."'>" . $BASE_URL . "/a/" . $path . "</a>");
        }
        else {
            die("Failed");
        }
    } else if (str_starts_with($url, "/a/")) {
        $path = explode("/a/", $url)[1];
        if ($path === ""){
            die("Invalid path");
        }
        $result = $db->query_url(md5($path));
        if ($result) {
            header("Location: " . $result);
            die();
        }
        else {
            die("Invalid path");
        }
    }?>
    </div>
</body>
</html>