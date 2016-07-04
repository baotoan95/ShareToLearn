<?php

/**
 * Description of Post
 *
 * @author BaoToan
 */
class EPost {

    private $id;
    private $title;
    private $content;
    private $author;
    private $views;
    private $comments;
    private $excerpt;
    private $catalogue;
    private $status;
    private $published;
    private $guid;
    private $cmt_allow;
    private $order;
    private $type;
    private $banner;
    private $password;
    private $parent;
    private $categories;
    private $tags;

    public function __construct($id = 0, $title = '', $content = '', $author = 0, 
            $views = 0, $comments = 0, $excerpt = '', $catalogue = '', 
            $status = '', $published = '', $guid = '', $cmt_allow = 0, $order = 0, 
            $type = '', $banner = '', $password = '', $parent = 0) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->views = $views;
        $this->comments = $comments;
        $this->excerpt = $excerpt;
        $this->catalogue = $catalogue;
        $this->status = $status;
        $this->published = $published;
        $this->guid = $guid;
        $this->cmt_allow = $cmt_allow;
        $this->order = $order;
        $this->type = $type;
        $this->banner = $banner;
        $this->password = $password;
        $this->parent = $parent;
    }

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getContent() {
        return $this->content;
    }

    function getAuthor() {
        return $this->author;
    }

    function getViews() {
        return $this->views;
    }

    function getComments() {
        return $this->comments;
    }

    function getExcerpt() {
        return $this->excerpt;
    }

    function getCatalogue() {
        return $this->catalogue;
    }

    function getStatus() {
        return $this->status;
    }

    function getPublished() {
        return $this->published;
    }

    function getGuid() {
        return $this->guid;
    }

    function getCmt_allow() {
        return $this->cmt_allow;
    }

    function getOrder() {
        return $this->order;
    }

    function getType() {
        return $this->type;
    }

    function getBanner() {
        return $this->banner;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

    function setViews($views) {
        $this->views = $views;
    }

    function setComments($comments) {
        $this->comments = $comments;
    }

    function setExcerpt($excerpt) {
        $this->excerpt = $excerpt;
    }

    function setCatalogue($catalogue) {
        $this->catalogue = $catalogue;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setPublished($published) {
        $this->published = $published;
    }

    function setGuid($guid) {
        $this->guid = $guid;
    }

    function setCmt_allow($cmt_allow) {
        $this->cmt_allow = $cmt_allow;
    }

    function setOrder($order) {
        $this->order = $order;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setBanner($banner) {
        $this->banner = $banner;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function getParent() {
        return $this->parent;
    }

    function setParent($parent) {
        $this->parent = $parent;
    }

    public function getCategories() {
        return $this->categories;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setCategories($categories) {
        $this->categories = $categories;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }

}
