<?php

namespace App\Models;

class HomeOwner {
    // Properties
    public $title;
    public $first_name;
    public $last_name;
    public $initials;

    // Constructor
    public function __construct($title, $first_name, $initials, $last_name) {
        $this->title = $title;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->initials = $initials;
    }
}
