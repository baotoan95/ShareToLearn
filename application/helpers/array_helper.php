<?php

function array_remove_by_value($array, $index) {
    unset($array[$index]);
    return array_values($array);
}
