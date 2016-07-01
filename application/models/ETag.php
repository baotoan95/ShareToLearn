<?php

/**
 * Description of Tag
 *
 * @author BaoToan
 */
class ETag {

    private $id;
    private $name;
    private $desc;
    private $slug;

    public function __construct($id = 0, $name = '', $desc = '', $slug = '') {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->slug = $slug;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDesc() {
        return $this->desc;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDesc($desc) {
        $this->desc = $desc;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

}
