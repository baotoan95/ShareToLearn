<?php

/**
 * Description of Category
 *
 * @author BaoToan
 */
class ECategory implements JsonSerializable {

    private $id;
    private $name;
    private $slug;
    private $desc;
    private $parent;

    public function ECategory($id = 0, $name = '', $slug = '', $desc = '', $parent = 0) {
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
    
    public function jsonSerialize() {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'desc' => $this->getDesc(),
            'parent' => $this->getParent()
        ];
    }

}
