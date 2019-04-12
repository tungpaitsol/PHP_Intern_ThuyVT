<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bài 2</title>
</head>
<body>
	<h3>In ra các số nguyên tố</h3>
	<form action="" method="post" accept-charset="utf-8">
		<input type="text" name="a" value="<?php echo isset($_POST['a']) ? $_POST['a'] : '' ?>" autofocus pattern="[0-9]?[0-9]+-[0-9]?[0-9]+(,[0-9]?[0-9]+-?[0-9]?[0-9])?" title="Ví dụ: 00-99,100-999">
		<input type="submit" name="ok" value="OK"> 
	</form>
	<?php 
		if(isset($_POST['ok']))
		{
			$a=isset($_POST['a']) ? $_POST['a'] : '';
			if(empty($a)){
				echo "Bạn chưa nhập dữ liệu.";
			}
			else{
			$arr1=explode(',', $a);
			$count=count($arr1);
			$temp = array();
			for($i=0; $i<$count; $i++){
				$arr2=explode('-', $arr1[$i]);
				for($j=$arr2[0]; $j<$arr2[1]; $j++)
				{
					if(prime($j)){
						$temp[] = $j;
						echo $j." ";
					}
				}
			}
			if(empty($temp))
				echo "Không có số nguyên tố nào trong khoảng " . $a;
		}}
	function prime($n) {
    if ($n < 2) {
        return false;
	    }
	    for($i = 2; $i <= sqrt ( $n ); $i ++) {
	        if ($n % $i == 0) 
	            return false;
	    }
	    return true;
	}
	?>
</body>
</html>