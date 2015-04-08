<?php
/* Armchair GNR heterostructure generator.*/ 

/**
* ���ɿ��Ϊ$n����Ϊ$type�����ߵ�����,���������ڵ�$p��
* @author zhouy
* @input $n,$type,$p
* @output ����2*$n+1��ԭ�ӵ�����
*/
function zhexian($n,$p,$type){
	$x=array();
	$y=array();
	$m=$n*2+1;
	for($i=0;$i<$m;$i++){
		$y[$i]=$i*sqrt(3)/2;
		$x[$i]=0.5*(1+($type*2-1)*($i%2)-$type)+$p*1.5;
	}
	return array($x,$y);
}

/** 
 * ���ɿ��Ϊ$n������Ϊ$p��AGNR������,��һ�����ߵ�������$type����
 * @author zhouy
 * @input $n,$p,$type
 * @output (2*$n+1)*$p��ԭ�ӵ�����
 */
function agnr($n,$p,$type){
	$x=array();
	$y=array();
	for($i=0;$i<$p;$i++){
		list($x1,$y1)=zhexian($n,$i,$type+(1-2*$type)*($i%2));
		for ($j=0;$j<count($x1);$j++){
			array_push($x,$x1[$j]);
			array_push($y,$y1[$j]);
		}
	}
	return array($x,$y);
}
function preFile(){
	global $latysmall; /* խ�߰���2*$latysmall+1��Cԭ�ӣ�$latysmall=3ʱ��Ϊ7 AGNR*/
	global $latExtend;/* �����խ�ߣ����ߵ�y������ͷ������$latExtend�������Σ�$latExtend=2ʱ������Ϊ[($latysamll-1)+2*$latExtend]*2+1=13 AGNR*/
	global $latxsmall,$latxbig;/* ���ģ�ͣ��м��ǳ��ߣ���ͷ�ǵȳ��Ķ̱�, $latxsmall��ʾ�̱��ɼ���*����*���*/
	if($latxsmall%2==0)$latxsmall+=1;
	if($latxbig%2==1)$latxbig+=1;
      global $bond;
	$x=array();
	$y=array();
    	list($x1,$y1)=agnr($latysmall,$latxsmall,0);
    	for($i=0;$i<count($x1);$i++){
    		array_push($x,$x1[$i]);
    		array_push($y,$y1[$i]);
    	}
    	list($x1,$y1)=agnr($latysmall-1+2*$latExtend,$latxbig,0);
    	for($i=0;$i<count($x1);$i++){
    		array_push($x,$x1[$i]+$latxsmall*1.5);
    		array_push($y,$y1[$i]-($latExtend-0.5)*sqrt(3));
    	}
    	list($x1,$y1)=agnr($latysmall,$latxsmall,1);
    	for($i=0;$i<count($x1);$i++){
    		array_push($x,$x1[$i]+($latxsmall+$latxbig)*1.5);
    		array_push($y,$y1[$i]);
    	}
    	$Natom=count($x);
    	
    	/* scale and translate the coordinates*/
    	for($i=0;$i<$Natom;$i++){
    		$x[$i]*=$bond;
    		$y[$i]*=$bond;
    	}
    	$minx=$miny=10000;
    	$maxx=$maxy=-10000;
    	for($i=0;$i<$Natom;$i++){
    		$minx=min($minx,$x[$i]);
    		$miny=min($miny,$y[$i]);
    		$maxx=max($maxx,$x[$i]);
    		$maxy=max($maxy,$y[$i]);
    	}
    	$xs=array();
    	$ys=array();
    	$length=$maxx-$minx+20*$bond;
    	$width=$maxy-$miny+20*$bond;
   	for($i=0;$i<$Natom;$i++){
    		$xs[$i]=($x[$i]-$minx+10*$bond)/$length;
    		$ys[$i]=($y[$i]-$miny+10*$bond)/$width;
    	}
    	
/* generate cell.in*/
$file=fopen("cell.in","w");
fprintf($file,"1.0
$length 0 0
0 $width 0 
0 0 100.0
$Natom
");
for($i=0;$i<$Natom;$i++){
fprintf($file,"%f\t%f\t0.5\n",$xs[$i],$ys[$i]);/* scaled x,y*/
}
fclose($file);
/* generate data.pos*/
$content="7
y
cell.in
y
1 1 1
1
3
C
0
CN.xyz
structure
map.in
";
		$file=fopen("in.disp","w");
	fprintf($file,$content);
	  $home=dirname(__FILE__);	
	shell_exec("$home/../../latgen <in.disp");
}
?>