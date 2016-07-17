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
    private $type;

    public function __construct($id = 0, $name = '', $slug = '', $parent = 0, $type = '') {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->parent = $parent;
        $this->type = $type;
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

    public function getType() {
        return $this->type;
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

    public function setType($type) {
        $this->type = $type;
    }

}
