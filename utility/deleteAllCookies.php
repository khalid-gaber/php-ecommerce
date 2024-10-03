<?php
function deleteAllCookies() {
    foreach ($_COOKIE as $name => $value) {
        setcookie($name, '', time() - 3600, '/');
        unset($_COOKIE[$name]);
    }
}
?>