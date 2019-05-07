
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bài 5</title>
</head>
<body>
	<?php session_start(); ?>
	<h3>Sắp xếp dữ liệu</h3>
	<form action="" method="post">
		<?php
		$i=0;
		$n=isset($_POST['input']) ? $_POST['input'] : '';
		$pro = array("Iphone X","Oppo F11 Pro","Oppo A7","Galaxy S10+","Iphone Xs Max","Vivo V15","Huawei P30","Oppo Find X","Galaxy S9+","Xiaomi Mi 8");
		$size = count($pro);
		$arr = array();
		if(isset($_POST['ok'])){
			for($i=0;$i<$n;$i++){
				$a[$i]=array($i,$pro[rand(0,$size-1)],rand(1000000,30000000),rand(1,50),rand(1,50));
				$total=$a[$i][2]*$a[$i][3];
				array_push($a[$i], $total);
				array_push($arr, $a[$i]);
			}
			table_echo($arr,$n);
			$_SESSION['arr'] = $arr;
		}
		$arr1=$_SESSION['arr'];
		if(isset($_POST['save'])){
			$in=$_POST['ordnum'];
			for($i=0; $i<$n; $i++){
				array_splice($arr1[$i], 4, 1, $in[$i] );
			}
			$arr1=bubble_sort($arr1,'4','0');
			table_echo($arr1,$n);
			$_SESSION['arr'] = $arr1;
		}
		if(isset($_POST['asc_pri'])){
			$arr1=bubble_sort($arr1,'2','0');
			table_echo($arr1,$n);
		}
		if(isset($_POST['des_pri'])){
			$arr1=bubble_sort($arr1,'2','1');
			table_echo($arr1,$n);
		}
		if(isset($_POST['asc_ord'])){
			$arr1=bubble_sort($arr1,'4','0');
			table_echo($arr1,$n);
		}
		if(isset($_POST['des_ord'])){
			$arr1=bubble_sort($arr1,'4','1');
			table_echo($arr1,$n);
		}
		if(isset($_POST['asc_total'])){
			$arr1=bubble_sort($arr1,'5','0');
			table_echo($arr1,$n);
		}
		if(isset($_POST['des_total'])){
			$arr1=bubble_sort($arr1,'5','1');
			table_echo($arr1,$n);
		}
		function table_echo($arr,$n){?>
			<table border="1px">
				<tr>
					<th>Product ID</th>
					<th>Product Name</th>
					<th>Product Price</th>
					<th>Quantity</th>
					<th>Order</th>
				</tr>
				<?php
				for($i=0;$i<$n;$i++){
					echo "<tr>";
					for($j=0; $j<4;$j++){
						echo "<td>";
						echo $arr[$i][$j];
						echo "</td>";
					}
					?>
					<td>
						<input type="number" name="ordnum[]" value="<?php echo isset($_POST['ordnum[]']) ? $_POST['ordnum'] : $arr[$i][$j] ?>">
					</td>
					<?php
				}
				?>
			</table>
			<?php
		}
		function bubble_sort($mang,$a,$type){
			$sophantu = count($mang);
			for ($i = 0; $i < ($sophantu - 1); $i++){
				for ($j = $i + 1; $j < $sophantu; $j++){
					if($type==0){
						if ($mang[$i][$a] > $mang[$j][$a]){
							$tmp = $mang[$j];
							$mang[$j] = $mang[$i];
							$mang[$i] = $tmp;
						}
					}
					else{
						if ($mang[$i][$a] < $mang[$j][$a]){
							$tmp = $mang[$j];
							$mang[$j] = $mang[$i];
							$mang[$i] = $tmp;
						}
					}
				}
			}
			return $mang;
		}
		?>
		<input type="number" name="input" 
		value="<?php echo isset($_POST['input']) ? $_POST['input'] : '' ?>">
		<input type="submit" name="ok" value="OK"><br>
		<input type="submit" name="save" value="Lưu order"><br>
		Price:<br>
		<input type="submit" name="asc_pri" value="Tăng dần">
		<input type="submit" name="des_pri" value="Giảm dần"><br>
		Order:<br>
		<input type="submit" name="asc_ord" value="Tăng dần">
		<input type="submit" name="des_ord" value="Giảm dần"><br>
		Tổng tiền:<br>
		<input type="submit" name="asc_total" value="Tăng dần">
		<input type="submit" name="des_total" value="Giảm dần">
	</body>
	</html>