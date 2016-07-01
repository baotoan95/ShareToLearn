<?php

function is_contain($objs, $obj) {
    foreach ($objs as $obj1) {
        if ($obj1 instanceof $obj) {
            return $obj == $obj1;
        }
    }
    return false;
}
