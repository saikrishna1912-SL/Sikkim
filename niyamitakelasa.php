<?php 
	include("serive/samparka.php");
	include("nayakaphalitansa_mulaka_unohs.php");
	
	$prathama = date('Ymd')."10001".sprintf("%04d",1);
	$sesa = $lastperiodid=date('Ymd')."10001".sprintf("%04d",1440);
	
	$ajitarika = date('Ymd');
	$ghanta = date('H');
	$nimisa = $ghanta*60;
	$bartamannimisa = date('i');
	$bartamankalasankhya = ceil(($nimisa+$bartamannimisa) / 1);
	
	$bartamankalakrama = $ajitarika ."10001". sprintf("%04d", $bartamankalasankhya);
	$bartamankalakrama = $bartamankalakrama + 1;
	
	$tarika = date('Y-m-d H:i:s');
	
	$dekhakalakrama = mysqli_query($conn,"select atadaaidi from `gelluonduhogu` order by kramasankhye desc limit 1");
	$kaladhadi = mysqli_num_rows($dekhakalakrama);
	$kalakramadhadi=mysqli_fetch_array($dekhakalakrama);
	
	if($kaladhadi == null){
		$tathya = mysqli_query($conn,"INSERT INTO `gelluonduhogu` (`atadaaidi`,`dinankavannuracisi`) VALUES ('".$bartamankalakrama."','".$tarika."')");
	}
	else if($prathama > $kalakramadhadi['atadaaidi']){
		$katiba=mysqli_query($conn,"TRUNCATE TABLE `gelluonduhogu`");
		//$truncateQuery=mysqli_query($con,"TRUNCATE TABLE `abracadabra`");
		$tathya = mysqli_query($conn,"INSERT INTO `gelluonduhogu` (`atadaaidi`,`dinankavannuracisi`) VALUES ('".$prathama."','".$tarika."')");
	}
	else{
		$parabartikrama = $kalakramadhadi['atadaaidi'] + 1;
		$tathya = mysqli_query($conn,"INSERT INTO `gelluonduhogu` (`atadaaidi`,`dinankavannuracisi`) VALUES ('".$parabartikrama."','".$tarika."')");
	}
	
	$safa_shonu = mysqli_query($conn,"UPDATE hastacalita_phalitansa SET sthiti='0'");
?>