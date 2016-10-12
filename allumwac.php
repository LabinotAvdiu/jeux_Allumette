<?php 

function allumwac($int){
	$total = "";
	$totalLignetop = "";
	$totalLignebootom = "";
	for ($i=0; $i < $int; $i++) { 
		$total .=" //";
		$totalLignetop .="  _" ;
		$totalLignebootom .="  ¯" ;
	}

	// echo $total."\n";
	// echo $int."\n\n";
	desing($total,$totalLignetop,$int,$totalLignebootom);
}
function desing($total,$totalLignetop,$int,$totalLignebootom){
	$ligne = "";
	$empty = "";
	for ($i=0; $i < strlen($total) +5; $i++) { 
		$ligne .="-";
		$empty.=" ";
	}
	echo "°".$ligne."°\n";
	echo "°".$empty."°\n";
	echo "°  \e[92m".$totalLignetop."\e[97m   °\n";
	echo "°  \e[92m".$total."\e[97m   °\n";
	echo "° \e[92m".$totalLignebootom."\e[97m    °\n";
	echo "°".$empty."°\n";
	echo "°".$ligne."°\n";


}
if($argv[1] == "--help"){
	help();
}else{
	$allum = 10;
	allumwac($allum);
	$tour = "";
	$difficulte = ["hard","easy"];
	$diff = "easy";
	if(in_array($argv[1],$difficulte)){
		$diff = $argv[1];
	}
	while ($allum ) {
		$tour = "User";
		$option = readline("User $>");
		readline_add_history($option);
		$option = readline_info()["line_buffer"];
		$int = toClean($option);
		if($int > 0 && $int < 4 && ($allum -$int) > 0){
			remove($int,$allum,$tour);
			if($allum != 1 && $diff=="easy" ){
				easyAi($allum,$tour);
			}
			if($allum != 1 && $diff=="hard" ){
				hardAi($allum,$tour);
			}
		}else{
			echo "you cannot play this number !\n";
		}
		if($allum == 1 ){
			return false;
		}
	}
}
function remove($int,&$allum,$tour){

	$allum -=$int;
	allumwac($allum);
	if($allum == 1){
		$allum = true;
		if( $tour == "User") {
			echo "you Win\n";
		}else{
			echo "Game over\n";
		}
	}
}
function hardAi(&$allum,$tour){
	$tour = "Computer";

	for ($i=1; $i <3 ; $i++) { 
		if(($allum - $i == 1 ) || (($allum - $i) % 3 == 2 && $allum >4)){
			echo "Computer $> $i\n";
			remove($i,$allum,$tour);
			return "";
		}
	}
	echo "Computer $> 3\n";
	remove(3,$allum,$tour);
}


function easyAi(&$allum,$tour){
	$tour = "Computer";

	for ($i=1; $i <3 ; $i++) { 
		if($allum - $i == 1 ){
			echo "Computer $> $i\n";
			remove($i,$allum,$tour);
			return "";
		}
	}
	$rand =rand (1,3);
	echo "Computer $> $rand\n";
	remove($rand,$allum,$tour);
}

function toClean($option){
	$trans = array(" "=>"","\n"=>"");
	return $option = strtr($option, $trans);
}
function help(){
	echo 
"	Choisir la difficulté \n
	$> php example.php easy pour simple\n
	$> php example.php hard pour difficile\n

	dafault  => easy\n
	";
}
?>