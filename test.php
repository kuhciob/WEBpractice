<?php 
 
 class A {
    public $property;
}

     $a = new A();
     $a->property = 1;
     $b = $a;
     $b->property = 2;

     echo $a->property;



?>