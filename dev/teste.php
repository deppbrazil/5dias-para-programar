<?php

// concatenando variáveis
	$nome = 'mir'; 
	$idade = '27 anos';
	echo "Olá, eu sou o " .$nome. " e tenho " .$idade. "</br></br>";
// concatenando variáveis

// contador 
	$x = 0;
	while ($x < 10 ) {
		echo "N: " .$x. "</br></br>";
		$x = $x + 1;	
	}
// contador

// função soma
	function somar ($y, $z) {

		$resultado = $y + $z;
		echo "Resultado da soma: " .$resultado;
	}

	somar(2, 5);
// função soma 

?>