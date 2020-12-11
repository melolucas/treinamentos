<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	//Retira acentos, de nomes das pessoas e deixa tudo em maiusculo
	function removerAcentos($variavel){

		//termos que serão subistituidos
		$procurar 	= array('À','Á','Ä','Ã','Â','È','Ë','É','Ê','Í','Ì','Ï','Ò','Ö','Ó','Ô','Õ','Ù','Ú','Ü','Ç','à','á','ä','ã','â','è','ë','é','ê','í','ì','ï','ò','ö','ó','ô','õ','ù','ú','ü','ç',);
		
		//termos a serem subistituidos
		$substituir = array('a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','c','a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','c',);
		
		//atualiza os campos pelos valores retornados
		$variavel   = str_replace($procurar, $substituir, $variavel);
		
		//converte os valores em entidades HTML, para evitar errros no processamento doss cabecalhos
		$variavel   = htmlentities($variavel);
		
		//deixa a variável em capslook
		$variavel   = strtoupper($variavel);

		return $variavel;
	}

	//REMOVE OS PONTOS E OS SINAIS para validação;
	function removerPontos($variavel){

		//termos que serão subistituidos
		$procurar 	= array('.',',','/','-','(',')',' ');
		
		
		//atualiza os campos pelos valores retornados
		$variavel   = str_replace($procurar, '', $variavel);
		
		//converte os valores em entidades HTML, para evitar errros no processamento doss cabecalhos
		$variavel   = htmlentities($variavel);

		return $variavel;
	}