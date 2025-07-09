<?php

class Car 
{
    // Properties / Fields
    private $brand;
    private $color;

    //Constructor
    public function __construct($brand, $color = "none")
    {
        $this->brand = $brand;
        $this->color = $color;
    }

    // Getter $ setter methods
    public function getBrand() 
    {
        return $this->brand;
    }
    // Setter method
        public function setBrand($brand) 
    {
        $this->brand = $brand;
    }
    public function getColor() 
    {
        return $this->color;
    }
    // Setter method
        public function setColor($color) 
    {
        $allowedColors = [
            "red",
            "blue",
            "green",
            "yellow"
        ];
        if (in_array($color, $allowedColors)) {
            $this->color = $color;
        }
        $this->color = $color;
    }
}