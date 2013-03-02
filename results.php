<?php
$key = 'AIzaSyD292Hx2skndazhuPsirjsPGctTdKcgy8I';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search = urlencode($_POST['search']);
    $url = 'https://www.googleapis.com/shopping/search/v1/public/products?key=' . $key . '&country=US&q=' . $search . '&maxResults=12';
    echo file_get_contents($url);
}
?>