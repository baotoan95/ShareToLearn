<?php

/**
 * Description of EStatistic
 *
 * @author BaoToan
 */
class EStatistic {

    private $date;
    private $count;
    private $total;
    private $yesterday;

    public function __construct($date = '', $count = 0, $total = 0, $yesterday = 0) {
        $this->date = $date;
        $this->count = $count;
        $this->total = $total;
        $this->yesterday = $yesterday;
    }

    public function getDate() {
        return $this->date;
    }

    public function getCount() {
        return $this->count;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getYesterday() {
        return $this->yesterday;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setCount($count) {
        $this->count = $count;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setYesterday($yesterday) {
        $this->yesterday = $yesterday;
    }

}
