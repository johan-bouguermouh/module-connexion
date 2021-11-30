<?php
class Vegetal
{
    public $nom_fruit;
    public $couleur;
    public $sucre_fruit;
    public $si_fruit;


 public function __construct($nom,$couleur,$sucre,$nature)
     {
            $this->nom_fruit = $nom;
            $this->couleur = $couleur;
            $this->sucre_fruit = $sucre;
            $this->si_fruit = $nature;
    }

 public function definition()
 {  
     if($this->si_fruit == True){
         $nature_fruit = 'c\'est un fruit';
     }
     else{
        $nature_fruit = 'c\'est un legume';
     }
     return "le fruit ".$this->nom_fruit." est" . $this->couleur . " est a un pouvoir sucrante de". $this->sucre_fruit." /10 et ".$nature_fruit;
 }
}
$orange = new Vegetal('orange','orange',8,True);
$poireau = new Vegetal('Poireau','vert',3,False);
echo($orange->definition());
echo($poireau->definition());

?>