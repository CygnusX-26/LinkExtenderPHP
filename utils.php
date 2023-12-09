<?php
if (!isset($BASE_URL)) {
    die("Missing required params: BASE_URL");
}
function check_url($url) {
    if (preg_match("/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/\/=]*)/", $url) && !str_contains($url, '\n')) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

function generate_ipsum() {
    try {
        $ipsum = file_get_contents("https://baconipsum.com/api/?type=all-meat&paras=1&start-with-lorem=1&format=text");
    } catch (Exception $e) {
        return FALSE;
    }
    return substr(str_replace(".", "", str_replace(" ", "-", $ipsum)), 0, 499);
}
?>