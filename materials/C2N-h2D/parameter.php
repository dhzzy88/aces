<?php
if(!$units)$units="metal";
//$species="CNSi";//or C
//***********general***********
if(!$method)$method="nvt";
$enforceThick=1;
$yp=1;#yPeriodic
$zp=1;
$useMini=1;
$dumpxyz=1;
$upP=3;
//in metal default
$srcUnit="metal";
$usinglat=1;
$xlen=100*Unit($srcUnit,"l");
$latx=10;$laty=6;$latz=1;
$ylen=20*Unit($srcUnit,"l");
$thick=3.35*Unit($srcUnit,"l");
$deta=2.5*Unit($srcUnit,"l");
$T=300*Unit("metal","T");//K for all units
$Thi=$T+10*Unit("metal","T");
$Tlo=$T - 10*Unit("metal","T");

$timestep=.5e-3*Unit($srcUnit,"t");
$equTime=100000;
$dumpRate=100000;
$aveRate=100000;
$excRate=500;
$corRate=2;
$runTime=10000000;
$seed=458127641;
//***********for nvt***********

$nstat=1;//heat bath width;unit=$deta
$nswap=$nstat;
$swapEnergy=5e-4*Unit("metal","E");
$wfix=2;//fix width
$Nbins=500;
$bond=1.42*Unit($srcUnit,"l");
$begin=1;

?>