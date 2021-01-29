<?php

class Archer extends Character {
    
    protected $arrowBag = 6;
    public $allowCritic = false;

    public function __construct($name) {
        parent::__construct($name);
        $this->daggerDamage = 5;
        $this->doubleShot = 40;
    }
    
    public function turn ($target) {
        $rand = rand(1, 10);
        if ($this->arrowBag === 0) {
            return $this->attack($target);
        } else if ($rand >= 4){
            return $this->arrowShot($target);     
        } else if ($rand <= 3 && !$this->allowCritic){
            return $this->arrowDoubleShot($target);
        }  
    }

    public function arrowDoubleShot(){
        $this->allowCritic = true;
        $status = "$this->name va tirer deux flèches au prochain tour!";
        return $status;  
    }


    public function arrowShot ($target) {
        if ($this->allowCritic && $this->arrowBag >= 2) {
            $target->setHealthPoints($this->doubleShot);
            $this->arrowBag -= 2;
            $status = "$this->name  tire deux flèches sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !"; 
            $this->allowCritic = false;
        } else {
            $target->setHealthPoints($this->damage);
            $this->arrowBag -= 1;
            $status = "$this->name  tire une flèche sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        }
        return $status;
    }

    public function attack($target) {
        $target->setHealthPoints($this->daggerDamage);
        $status = "$this->name donne un coup de dague à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }


}

