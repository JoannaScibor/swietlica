<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Świetlica</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
<h1>Zapisy dzieci na świetlicę szkolną!</h1></br>
<h2>Sprawdź aktualną listę dzieci przyjętych do świetlicy szkolnej!</h2></br>
<div id="pojemnik">
<div id="pojemnik1">
<form action="index.php" name="przyjeci" method="post">
<label>Wpisz rok urodzenia Twojego dziecka: <input type="text" name="rok"></label></br>
<input type="submit" value="SPRAWDŹ" id="sprawdz">

</form>
</div>
<div id="pojemnik2">
</br></br></br></br><h2 id="wynik"><em>Aktualna lista przyjętych dzieci, wg roku urodzenia: </em></h2>
<?php
	if(isset($_POST['rok'])){
		
		if(empty($_POST['rok'])){
			echo "Nie wpisano roku urodzenia";
		}
		else {
		
		
	
	require "connect.php";
	$conn=mysqli_connect($host, $user, $password, $db_name);
	mysqli_set_charset($conn,"utf8");
	$rok=$_POST["rok"];
	$q="SELECT imie,nazwisko FROM dzieci WHERE rok='$rok'";
	$result= mysqli_query($conn,$q);
	$num_rows=mysqli_num_rows($result);
	if ($num_rows<=0){
	echo "<span style='color:yellow; font-size:23px; tex-align:center;'><em>Niestety w tym roku nie udało się zapisać Twojego dziecka na świetlicę. Możesz zapisać Twoje dziecko na listę rezerwową - o wszelkich zmianach dotyczących listy osób zakwalifikowanych oraz limitach liczby dzieci przyjętych na świetlicę zostaniesz niezwłocznie poinformowany drogą mailową.</em></span>";}
	
	
	WHILE($wiersz=mysqli_fetch_row($result))
	{
		echo $wiersz[0]." ".$wiersz[1]."</br>";
	
		}
		}
	}
	
	mysqli_close($conn);


	

?>
</div>
</div>
<div id="klasa4">
<h2><em>Oblicz miesięczną składkę za pobyt dziecka na świetlicy: </em></h2>
<form name="skladka">
<label id="l1"><em>Wpisz ilość dni: </em><input type="text" name="dni"></label>
</br></br><label>Zaznacz, jeśli do naszej szkolnej świetlicy uczęszcza również rodzeństwo dziecka </br> <input type="checkbox" name="rodzenstwo"></label>
</br><input type="button" name="oblicz" onclick="policz()" value="Oblicz składkę">
<span id="wynik1"></span>
</form>
<script type="text/javascript">
function policz(){
var dni1=document.forms['skladka'].dni.value;
var skladka1= Number(dni1)*6;
if (document.forms['skladka'].rodzenstwo.checked==true) {
	var znizka=skladka1*0.8;
	document.getElementById('wynik1').innerHTML="Miesięczna składka za pobyt Twojego dziecka wynosi: " + znizka + " zł.";

}
else {
document.getElementById('wynik1').innerHTML="Miesięczna składka za pobyt Twojego dziecka wynosi: " + skladka1 + " zł.";
}}

//nazwy pól absolutnie nie mogą się powtarzać, bo wykrzacza JS 
</script>

</div>
</body>

</html>