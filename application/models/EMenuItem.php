<?php

/**
 * Description of MenuItem
 *
 * @author BaoToan
 */
class EMenuItem {

    private $id;
    private $name;
    private $slug;
    private $parent;
    private $meta;

    public function __construct($id = 0, $name = '', $slug = '', $parent = 0, $meta = '') {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->parent = $parent;
        $this->meta = $meta;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getParent() {
        return $this->parent;
    }

    public function getMeta() {
        return $this->meta;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function setParent($parent) {
        $this->parent = $parent;
    }

    public function setMeta($meta) {
        $this->meta = $meta;
    }

}
