<?php

/**
 * Description of Tag
 *
 * @author BaoToan
 */
class ETag implements JsonSerializable {

    private $id;
    private $name;
    private $desc;
    private $slug;
    private $count;

    public function __construct($id = 0, $name = '', $desc = '', $slug = '', $count = 0) {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->slug = $slug;
        $this->count = $count;
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

    public function getCount() {
        return $this->count;
    }

    public function setCount($count) {
        $this->count = $count;
    }
    
    public function jsonSerialize(){
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'desc' => $this->getDesc(),
            'slug' => $this->getSlug(),
            'count' => $this->getCount()
        ];
    }

}
