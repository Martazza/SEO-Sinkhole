<?php

$DICTIONARY_FILE = ".\words.txt";
$words = file( $DICTIONARY_FILE );
$count = count( $words );
$ALGO = "sha512";

function sentencer( $sentence, $words, $count, $ALGO = "crc32"){
	$strArr = str_split($sentence);//explode(" ", $sentence);

	$sentence = [];
	foreach( $strArr as $word){
		$hashed = hash($ALGO, worder($word));
		$hashedHex = ToHex($hashed);
		$mod = bcmod($hashedHex, $count);
		$sentence[] = trim($words[$mod]);
	}
	return implode(" ", $sentence);
}

function worder($word){
	$wordSize = sizeof($word);
	$pos = $wordSize % 22;
	$str_hex = strtoupper(ToHex($word));
	$secondtable = array(43, 31, 11, 79, 43, 36, 53, 54, 91, 55,
						 83, 67, 21, 22, 11, 37, 75, 12, 12, 88,
						 43, 50, 99);
	$hashed = strtoupper(ToHex(chr($secondtable[$pos])));
	for($i = 0; $i < strlen($str_hex); $i += 2)
	{
		$hashed .= strtoupper(ToHex(chr(($secondtable[$pos] & $wordSize) >> 4)));
		$hashed .= $str_hex[$i];
		$hashed .= strtoupper(ToHex(chr($secondtable[$pos] & $wordSize)));
		$hashed .= $str_hex[$i + 1];
		$pos == $wordSize ? $pos = 0 : $pos++;
	}
	return $hashed;
}

function ToHex($string)
{
	$hex = "";
	for ($i = 0; $i < strlen($string); $i++)
		$hex .= dechex(ord($string[$i]));
	return $hex;
}

echo sentencer("Figurin è mio", $words, $count, $ALGO);