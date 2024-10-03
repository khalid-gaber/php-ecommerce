<?php

function checkLang($lang, $en, $ar) {
    if($lang === 'ar') {
        return $ar;
    } else {
        return $en;
    }
}

?>