<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Exercício IMC</title>
</head>
<body>
    <?php
        $peso = 70;
        $altura = 1.80;
        $imc = $peso / pow($altura, 2);

        if($imc < 18.5) {
            $classificacao = "Magreza";
        }
        else if($imc < 25) {
            $classificacao = "Normal";
        }
        else if($imc < 30) {
            $classificacao = "Sobrepeso";
            $obesidade = "Grau I";
        }
        else if($imc < 40) {
            $classificacao = "Obesidade";
            $obesidade = "Grau II";
        }
        else {
            $classificacao = "Obesidade Grave";
            $obesidade = "Grau III";
        }