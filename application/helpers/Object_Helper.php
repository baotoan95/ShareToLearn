<?php

function is_contain($objs, $obj) {
    foreach ($objs as $obj1) {
        if ($obj1 instanceof $obj && $obj1 == $obj) {
            return TRUE;
        }
    }
    return FALSE;
}
