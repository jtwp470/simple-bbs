<?php
function h($str) {
    return htmlspecialchars($str);
}

function alert($s, $type = "success") {
    return "<div class='alert alert-$type'>h($s)</div>";
}