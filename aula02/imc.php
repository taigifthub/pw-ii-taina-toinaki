<?php 
   $peso = 75;
   $altura = 1.90;

   $result = $peso/($altura*$altura);

   echo "Seu peso é: ", $peso,"kg.";
   echo "<br>","Sua altura é: ",$altura,"m.";

   if ($result <=16.9) {
    echo"<br>", "Seu IMC é: ", $result, "<br>", "Sua classificação é: Muito abaixo do peso";
   }
   else if ($result<=18.4) {
    echo"<br>", "Seu IMC é: ", $result, "<br>", "Sua classificação é: Abaixo do peso";
   }
   else if ($result<=24.9) {
    echo"<br>", "Seu IMC é: ", $result, "<br>", "Sua classificação é: Normal";
   }
   else if ($result<=29.9) {
    echo"<br>", "Seu IMC é: ", $result, "<br>", "Sua classificação é: Acima do peso";
   }
   else if ($result<=34.9) {
    echo"<br>", "Seu IMC é: ", $result, "<br>", "Sua classificação é: Obesidade grau I";
   }
   else if ($result<=40) {
    echo"<br>", "Seu IMC é: ", $result, "<br>", "Sua classificação é: Obesidade grau II";
   }
   else if ($result >40) {
    echo"<br>", "Seu IMC é: ", $result, "<br>", "Sua classificação é: Obesidade grau III";
   }

?>