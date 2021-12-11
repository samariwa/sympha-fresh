<?php
require_once '../core/init.php';
function sanitize($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

 $user = new User();
 $logout = $user->logout();
    ?>