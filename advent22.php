<?php

class Boss {
	public $damage, $life;
	public function __construct($life, $damage) {
		$this->life = $life;
		$this->damage = $damage;
	}
}

class Player {
	public $life, $manaSpent, $mana;
	public function __construct() {
		$this->life = 50;
		$this->mana = 500;
	}
}


class GameState {
	public $boss;
	public $player;
	public $shield = 0;
	public $poison = 0;
	public $recharge = 0;
	public $spellscast;
	
	public function __clone() {
		$this->boss = clone $this->boss;
		$this->player = clone $this->player;
	}
}

function applyPoison($gs) {
	if($gs->poison > 0)
	{
		$gs->boss->life -= 3;
		$gs->poison--;
	}
	return ($gs->boss->life <= 0) ? true : false;
}

function applyRecharge($gs) {
	if($gs->recharge > 0)
	{
		$gs->player->mana += 101;
		$gs->recharge--;
	}
}

function applyShield($gs) {
	if($gs->shield > 0)
	{
		$gs->shield--;
	}
}



function playerTurn ($spell, $gs) {
	global $maxMana;
	$gs->player->life--;
	if($gs->player->life <= 0) return false;
	if(applyPoison($gs)) return true;
	applyRecharge($gs);
	applyShield($gs);
	switch($spell) {
		case "missile":
		{
			if($gs->player->mana < 53) return false;
			$gs->boss->life -= 4;
			$gs->player->mana -= 53;
			$gs->player->manaSpent += 53;
			break;
		}
		case "drain":
		{
			if($gs->player->mana < 73) return false;
			$gs->boss->life -= 2;
			$gs->player->life += 2;
			$gs->player->mana -= 73;
			$gs->player->manaSpent += 73;
			break;
		}
		case "shield":
		{
			if($gs->player->mana < 113) return false;
			if($gs->shield > 0) return false; 
			$gs->shield = 6;
			$gs->player->mana -= 113;
			$gs->player->manaSpent += 113;
			break;
		}
		case "poison":
		{
			if($gs->player->mana < 173) return false;
			if($gs->poison > 0) return false;
			$gs->poison = 6;
			$gs->player->mana -= 173;
			$gs->player->manaSpent += 173;
			break;
		}
		case "recharge":
		{
			if($gs->player->mana < 229) return false;
			if($gs->recharge > 0) return false;
			$gs->recharge = 5;
			$gs->player->mana -= 229;
			$gs->player->manaSpent += 229;
			break;
		}
	}
	if($gs->player->manaSpent > $maxMana) return false; //go home, you're drunk
	//var_dump($gs);
	return true;
}

function bossTurn ($gs) {
	if(applyPoison($gs)) return;
	applyRecharge($gs);
	$damage = ($gs->shield > 0) ? $gs->boss->damage - 7 : $gs->boss->damage;
	$gs->player->life -= $damage;
	if($gs->player->life < 0) return;
	applyShield($gs);
	//var_dump($gs);
}

function goDeeper($spell, $gs)
{
	global $maxMana;
	$gs->spellscast[] = $spell;
	if(!playerTurn($spell, $gs)) return false;
	if($gs->boss->life <= 0)
	{
		print_r($gs->spellscast);
	    echo "$maxMana<BR>";
		$maxMana = min($maxMana, $gs->player->manaSpent);
		return true;
	}
	bossTurn($gs);
	if($gs->boss->life <= 0)
	{
		print_r($gs->spellscast);
	    echo "$maxMana<BR>";
		$maxMana = min($maxMana, $gs->player->manaSpent);
		return true;
	}
	if($gs->player->life <= 0) return false;
	global $spells;
	foreach($spells as $newspell)
	{
		$newgs = clone $gs;	
		goDeeper($newspell, $newgs);
		//var_dump($newgs);	
	}
}

function test() {
	$gs = new GameState();
	$gs->boss = new Boss(55, 8);
	$gs->player = new Player();
	$testspells = [ "poison", "missile", "missile", "missile", "missile", "missile" ];
	foreach($testspells as $spell)
	{	
		playerTurn($spell, $gs);
		bossTurn($gs);
		var_dump($gs);
	}
}

$spells = [ "missile", "drain", "shield", "poison", "recharge" ];

$maxMana = 1500;
function go() {
	$gs = new GameState();
	$gs->boss = new Boss(55, 8);
	$gs->player = new Player();
	global $spells;
	foreach($spells as $spell)
	{
		$newgs = clone $gs;	
		goDeeper($spell, $newgs);
		//var_dump($newgs);	
	}
}
go();
//test();
//var_dump($gs);

echo $maxMana;
?>