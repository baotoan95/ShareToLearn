<?php

/**
 * Description of MenuItem
 *
 * @author BaoToan
 */
class EMenuItem {

    private $name;
    private $link;
    private $order;

    function __construct($name, $link, $order) {
        $this->name = $name;
        $this->link = $link;
        $this->order = $order;
    }

    function getName() {
        return $this->name;
    }

    function getLink() {
        return $this->link;
    }

    function getOrder() {
        return $this->order;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setOrder($order) {
        $this->order = $order;
    }

}
