<?php

/**
 * Description of User
 *
 * @author BaoToan
 */
class EUser {

    private $id;
    private $username;
    private $password;
    private $full_name;
    private $avatar;
    private $desc;
    private $bio;
    private $email;
    private $phone;
    private $facebook;
    private $skype;
    private $google;
    private $key;
    private $actived;
    private $role;
    private $non_blocked;

    public function __construct($id, $username, $password, $full_name, $avatar, $desc, $bio, $email, $phone, $facebook, $skype, $google, $key, $actived, $role, $non_blocked) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->full_name = $full_name;
        $this->avatar = $avatar;
        $this->desc = $desc;
        $this->bio = $bio;
        $this->email = $email;
        $this->phone = $phone;
        $this->facebook = $facebook;
        $this->skype = $skype;
        $this->google = $google;
        $this->key = $key;
        $this->actived = $actived;
        $this->role = $role;
        $this->non_blocked = $non_blocked;
    }

    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getFull_name() {
        return $this->full_name;
    }

    function getAvatar() {
        return $this->avatar;
    }

    function getDesc() {
        return $this->desc;
    }

    function getBio() {
        return $this->bio;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function getFacebook() {
        return $this->facebook;
    }

    function getSkype() {
        return $this->skype;
    }

    function getGoogle() {
        return $this->google;
    }

    function getKey() {
        return $this->key;
    }

    function getActived() {
        return $this->actived;
    }

    function getRole() {
        return $this->role;
    }

    function getNon_blocked() {
        return $this->non_blocked;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setFull_name($full_name) {
        $this->full_name = $full_name;
    }

    function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

    function setDesc($desc) {
        $this->desc = $desc;
    }

    function setBio($bio) {
        $this->bio = $bio;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setFacebook($facebook) {
        $this->facebook = $facebook;
    }

    function setSkype($skype) {
        $this->skype = $skype;
    }

    function setGoogle($google) {
        $this->google = $google;
    }

    function setKey($key) {
        $this->key = $key;
    }

    function setActived($actived) {
        $this->actived = $actived;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function setNon_blocked($non_blocked) {
        $this->non_blocked = $non_blocked;
    }

}
