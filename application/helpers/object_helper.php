<?php

function is_contain($objs, $obj) {
//    print_r( json_decode(json_encode($obj), true));
//    echo "<br/>";
//    print_r(json_decode(json_encode($objs), true));
//    echo "<br/>";
//    echo "<br/>";
    return in_array(json_decode(json_encode($obj), true), json_decode(json_encode($objs), true));
//    foreach ($objs as $obj1) {
//        echo $obj1->getId() . ' - ' . $obj->getId() . '<br/>';
//        if ($obj1 instanceof $obj && $obj1 == $obj) {
//            
//            return TRUE;
//        }
//    }
//    return FALSE;
}
