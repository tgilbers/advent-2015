<?php

trait HasDamage {
	private $damage = 0;
	public function setDamage($damage) {
		$this->damage = $damage;
	}
	public function getDamage() {
		return $this->damage;
	}
	public function addDamage($damage) {
		$this->damage += $damage;
	}	
}
trait HasArmor {
	private $armor = 0;
	public function setArmor($armor) {
		$this->armor = $armor;
	}
	public function getArmor() {
		return $this->armor;
	}
	public function addArmor($armor) {
		$this->armor += $armor;
	}
}
trait HasLife {
	public $life = 0;
	public function setLife($life) {
		$this->life = $life;
	}
	public function getLife() {
		return $this->life;
	}
	public function loseLife($life) {
		$this->life -= $life;
		return $this->life;
	}
}

trait HasCost {
	private $cost = 0;
	public function setCost($cost) {
		$this->cost = $cost;
	}
	public function getCost() {
		return $this->cost;
	}
	public function addCost($cost) {
		$this->cost += $cost;
	}
}

class Weapon {
	use HasDamage, HasCost;
	public function __construct($cost, $damage) {
		$this->setCost($cost);
		$this->setDamage($damage);
	}
}

class Armor {
	use HasArmor, HasCost;
	public function __construct($cost, $armor) {
		$this->setCost($cost);
		$this->setArmor($armor);
	}
}


class Ring {
	use HasDamage, HasArmor, HasCost;
	public function __construct($cost, $damage, $armor) {
		$this->setCost($cost);
		$this->setArmor($armor);
		$this->setDamage($damage);
	}
}

class Character {
	use HasDamage, HasArmor, HasLife;
	public function __construct($life, $damage, $armor) {
		$this->setLife($life);
		$this->setDamage($damage);
		$this->setArmor($armor);
	}

}

class Player extends Character {
	use HasCost;
	public function __construct($weapon, $armor, $ring1, $ring2) {
		parent::__construct(100, 0, 0);
		$this->addWeapon($weapon);
		$this->addItemArmor($armor);
		$this->addRing($ring1);
		$this->addRing($ring2);
	}
	public function addWeapon($weapon) {
		$this->addDamage($weapon->getDamage());
		$this->addCost($weapon->getCost());
	}
	public function addItemArmor($armor) {
		$this->addArmor($armor->getArmor());
		$this->addCost($armor->getCost());
	}
	public function addRing($ring) {
		$this->addDamage($ring->getDamage());
		$this->addArmor($ring->getArmor());
		$this->addCost($ring->getCost());
	}
}

class Fighter {
	private $player;
	private $boss;
	private $defaultBoss;
	public function __construct($boss) {
		$this->defaultBoss['char'] = $boss;
	}
	public function setPlayer($player) {
		$this->player['char'] = $player;
	}
	public function fight() {
		$this->boss['char'] = clone $this->defaultBoss['char'];
		$this->player['damage'] = max(1, $this->player['char']->getDamage() - $this->boss['char']->getArmor());
		$this->boss['damage'] = max(1, $this->boss['char']->getDamage() - $this->player['char']->getArmor());
		$active = '';
		$inactive = '';
		while(true)
		{
			$active = ($active == 'player') ? "boss" : "player";
			$inactive = ($active == 'player') ? "boss" : "player";
			if($this->{$inactive}['char']->loseLife($this->{$active}['damage']) <= 0)
			{
				return ($active == 'player') ? true : false;
			}
			//echo "$active hits $inactive for {$this->{$active}['damage']} damage ({$this->{$inactive}['char']->life} left)<BR>";			
		}
	}
}

$weapons[] = new Weapon(8, 4);
$weapons[] = new Weapon(10, 5);
$weapons[] = new Weapon(25, 6);
$weapons[] = new Weapon(40, 7);
$weapons[] = new Weapon(74, 8);

$armors[] = new Armor(0, 0);
$armors[] = new Armor(13, 1);
$armors[] = new Armor(31, 2);
$armors[] = new Armor(53, 3);
$armors[] = new Armor(75, 4);
$armors[] = new Armor(102, 5);

$rings[] = new Ring(0, 0, 0);
$rings[] = new Ring(0, 0, 0);
$rings[] = new Ring(25, 1, 0);
$rings[] = new Ring(50, 2, 0);
$rings[] = new Ring(100, 3, 0);
$rings[] = new Ring(20, 0, 1);
$rings[] = new Ring(40, 0, 2);
$rings[] = new Ring(80, 0, 3);

getRingSets(array(), $rings);

function getRingSets($comb, $rings)
{
	global $ringsets;
	//echo count($comb) . " " . count($rings) . PHP_EOL;
	//var_dump(count($rings));
	if(count($comb) == 2)
	{
		$ringsets[] = $comb;
		return;
	}
	if (count($rings) == 0) return;
	$newring = array_shift($rings);
	getRingSets($comb, $rings);
	$comb[] = $newring;
	getRingSets($comb, $rings);	
}

foreach($weapons as $weapon) {
	foreach($armors as $armor) {
		foreach($ringsets as $ringset) {
			$players[] = new Player($weapon, $armor, $ringset[0], $ringset[1]);
		}
	}
}

function sortByCost(Player $a, Player $b){
    return $b->getCost() - $a->getCost();
}

usort($players, "sortByCost");

//echo count($players);
//var_dump($players);
$boss = new Character(109, 8, 2);
$fighter = new Fighter($boss);
foreach($players as $player) {
	$fighter->setPlayer($player);
	if(!$fighter->fight()) {
		var_dump($fighter);
		exit;
	}
}
?>