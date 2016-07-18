<?php

/**
 * Description of EComment
 *
 * @author BaoToan
 */
class EComment implements JsonSerializable {

    private $id;
    private $postId;
    private $author;
    private $email;
    private $website;
    private $userId;
    private $date;
    private $status;
    private $type;
    private $content;
    private $parent;
    private $prev_status;
    private $post;

    public function __construct($id = 0, $postId = 0, $author = '', $email = '', $website = '', $userId = 0, $date = '', $status = '', $type = '', $content = '', $parent = 0) {
        $this->id = $id;
        $this->postId = $postId;
        $this->author = $author;
        $this->email = $email;
        $this->website = $website;
        $this->userId = $userId;
        $this->date = $date;
        $this->status = $status;
        $this->type = $type;
        $this->content = $content;
        $this->parent = $parent;
    }

    public function getId() {
        return $this->id;
    }

    public function getPostId() {
        return $this->postId;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getWebsite() {
        return $this->website;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getType() {
        return $this->type;
    }

    public function getContent() {
        return $this->content;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPostId($postId) {
        $this->postId = $postId;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setWebsite($website) {
        $this->website = $website;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setParent($parent) {
        $this->parent = $parent;
    }

    public function getPrev_status() {
        return $this->prev_status;
    }

    public function setPrev_status($prev_status) {
        $this->prev_status = $prev_status;
    }

    public function getPost() {
        return $this->post;
    }

    public function setPost($post) {
        $this->post = $post;
    }

    public function jsonSerialize() {
        return [
            "id" => $this->getId(),
            "author" => $this->getAuthor(),
            "content" => $this->getContent(),
            "date" => $this->getDate(),
            "status" => $this->getStatus()
        ];
    }

}
