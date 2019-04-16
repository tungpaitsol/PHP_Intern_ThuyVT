<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bài 3</title>
</head>
<body>
	<h3>Tạo mảng / chia mảng</h3>
	<form method="post">
	<input type="number" name="n" value="<?php echo isset($_POST['n']) ? $_POST['n'] : '' ?>" autofocus>
	<input type="submit" name="tm" value="Tạo mảng">
	<input type="submit" name="cm" value="Chia mảng">
	</form>

	<?php
	$arr = array();
	$n=isset($_POST['n']) ? $_POST['n'] : '';
	if(isset($_POST['tm'])){
		if($n<=0)
			echo "Không tạo được mảng.";
		else{
			for($i=0; $i<$n; $i++){
				$type=rand(0,1);
				if($type)
					$arr[$i]=rand_string(ceil(rand($n/4, 3*$n/4)));
				else
					$arr[$i]=rand_num(ceil(rand($n/4, 3*$n/4)));
			}
			var_dump($arr);
			$_SESSION['array'] = $arr;
		}
	}
	
	if(isset($_POST['cm'])){
		$arr = $_SESSION['array'];
		$arrint=[];
		$arrstr=[];
		for($i=0; $i<$n; $i++){
			if(is_string($arr[$i]))
				array_push($arrstr, $arr[$i]);
			else
				array_push($arrint, $arr[$i]);
		}
		var_dump($arrint);
	?>
	<br>
	<?php
		var_dump($arrstr);
	}



	function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		$str = substr( str_shuffle( $chars ), 0, $length/2 );
		for( $i = 0; $i < $length/2; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
	}



	function rand_num($length){
		$chars = "0123456789";
		$size = strlen( $chars );
		$str = substr( str_shuffle( $chars ), 0, $length/2 );
		for( $i = 0; $i < $length/2; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		$str=(int)$str;
		return $str; 
	}
	?>
</body>
</html>