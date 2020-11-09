<?php
function getFile($filename) {
    include($_SERVER['DOCUMENT_ROOT'] . "/includes/" . $filename);
}

function appFile($filename) {
    include($_SERVER['DOCUMENT_ROOT'] . "/app/php/" . $filename);
}