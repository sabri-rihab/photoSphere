<?php
class Image {
    private $name;
    private $size;
    private $type;
    private $dimension;

    public function __construct($name, $size, $type, $dimension)
    {
        $this->name = $name;
        $this->size = $size;
        $this->type = $type;
        $this->dimension = $dimension;
    }

    public function getName(){return $this->name;}
    public function getSize(){return $this->size;}
    public function getType(){return $this->type;}
    public function getDimension(){return $this->dimension;}
}