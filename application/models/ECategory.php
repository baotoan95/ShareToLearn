<?php

/**
 * Description of Category
 *
 * @author BaoToan
 */
class ECategory {

    private $id;
    private $name;
    private $slug;
    private $desc;
    private $parent;
    
    public function __construct() {
        
    }

    public function ECategory($name, $slug, $desc, $parent, $id = 0) {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->desc = $desc;
        $this->parent = $parent;
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

    public function getDesc() {
        return $this->desc;
    }

    public function getParent() {
        return $this->parent;
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

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function setParent($parent) {
        $this->parent = $parent;
    }

}
