<?php
require 'config.php';
/*
	Generates
*/
$hasher = new Hasher('acskodsamk mklasdk lmdakls');

foreach($hasher->getSentences() as $sentence){
	echo "$sentence\n";
}


echo "\n\n\n\n" . $hasher->getParagraph();

/**
 * [Description Hasher]
 */
class Hasher {

	/**
	 * @var [string]
	 */
	public $word;
	public $seed;

	function __construct($word){
		$this->word = $word;
		$this->init();
	}

	/**
	 * This initialize
	 */
	function init(){
		$seed = $this->updateSeed($this->word);
		mt_srand($seed);
	}

	function updateSeed($word){
		$this->seed = $seedVal = $this->getBinaryWord($word);
		return intval($this->seed);
	}

	/**
	 * @return string Body Generated from a word
	 */
	function getBody(){
		$body = '';
		$seedSplit = str_split($this->seed, intval($this->seed) % 6 + 1);
		foreach($seedSplit as $times){
			$body .= str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_');
		}
        return $body;
	}

	/**
	 * @return string Body Generated from a word
	 */
	function getUrl(){
		return str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_');
	}

	/**
	 * @param  $seed if not passed uses as seed $this->getUrl();
	 * @return [string] return a sentence
	 */
	function getSentence($seed =null){
		$seed = $seed ?? $this->getBody();
		return Sentencer::getSentence($seed);
	}

	/**
	 * @param mixed $seed
	 * 
	 * @return array[string] list of sentences
	 */
	function getSentences(){
		$sentences = [];
		$seed = $seed ?? $this->getBody();
		$chunks = str_split($seed, (intval($seed) % 6 +1));
		foreach($chunks as $chunk) {
			$sentences[] = $this->getSentence($chunk);
		}
		return $sentences;
	}

	/**
	 * @param mixed $seed
	 * 
	 * @return array[string] list of sentences
	 */
	function getParagraph(){
		return Sentencer::getParagraph();
	}

    function getBinaryWord($word){
		$binWord = "";
		for($i = 0; $i < strlen($word); $i++) {
			$binWord .= ord($word[$i]);
		}
		return $binWord;
	}

}


class Sentencer {

	static function getParagraph(){
		$paragraph = "";
		for($i = 0; $i < (rand() % 1000 + 2); $i++){
			$val = Sentencer::getSentence();
			$paragraph .= $val;
			if(rand() % 1000 <= 100){
				$paragraph.="\n\n\n";
			}
			if(rand() % 1000 <= 250){
				$paragraph.="\n";
			}
		}
		return $paragraph;
	}

	static function getSentence(){
		return sprintf("%s %s %s %s.", 
		Sentencer::getSubject(),
		Sentencer::getVerb(),
		Sentencer::getObject(),
		// Sentencer::getManner($word),
		// Sentencer::getPlace($word),
		 Sentencer::getTime()
	    );
	}

	static function getSubject(){
		$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
		shuffle($input);
		return $input[0];
	}

	static function getVerb(){
		$input = array("eat", "play", "fuck");
		shuffle($input);
		return $input[0];
	}

	static function getObject(){
		$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
		shuffle($input);
		return $input[0];
	}

	// static function getManner($word){
	// 	$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
	// 	shuffle($input);
	// 	return $input[0];
	// }
	// static function getPlace($word){
	// 	$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
	// 	shuffle($input);
	// 	return $input[0];
	// }
	static function getTime(){
		$input = array("today", "tomorrow", "now", "on Monday", "on Tuesday");
		shuffle($input);
		return $input[0];
	}



}