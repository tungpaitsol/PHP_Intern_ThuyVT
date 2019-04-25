
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bài 4</title>
</head>
<body>
	<h3>Sắp xếp dữ liệu</h3>
	<?php session_start(); 
	$i=0;
	$n=isset($_POST['input']) ? $_POST['input'] : '';
	$pro = array("Iphone X","Oppo F11 Pro","Oppo A7","Samsung Galaxy S10+","Iphone Xs Max","Vivo V15","Huawei P30","Oppo Find X","Samsung Galaxy S9+","Xiaomi Mi 8");
	$size = count($pro);
	$arr = array();
	if(isset($_POST['ok'])){
		for($i=0;$i<$n;$i++){
			$a[$i]=array($pro[rand(0,$size-1)],rand(1000000,30000000),rand(1,50),rand(1,50));
			$total=$a[$i][1]*$a[$i][2];
			array_push($a[$i], $total);
			array_push($arr, $a[$i]);
		}
		table_echo($arr,$n);
		$_SESSION['arr'] = $arr;
	}
	$arr1=$_SESSION['arr'];
	if(isset($_POST['asc_pri'])){
		$arr1=bubble_sort($arr1,'1','0');
		table_echo($arr1,$n);
	}
	if(isset($_POST['des_pri'])){
		$arr1=bubble_sort($arr1,'1','1');
		table_echo($arr1,$n);
	}
	if(isset($_POST['asc_ord'])){
		$arr1=bubble_sort($arr1,'3','0');
		table_echo($arr1,$n);
	}
	if(isset($_POST['des_ord'])){
		$arr1=bubble_sort($arr1,'3','1');
		table_echo($arr1,$n);
	}
	if(isset($_POST['asc_total'])){
		$arr1=bubble_sort($arr1,'4','0');
		table_echo($arr1,$n);
	}
	if(isset($_POST['des_total'])){
		$arr1=bubble_sort($arr1,'4','1');
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
				echo "<td>";
				echo $i;
				echo "</td>";
				for($j=0; $j<4;$j++){
					echo "<td>";
					echo $arr[$i][$j];
					echo "</td>";
				}
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
</table>
<form action="" method="post">
	<input type="text" name="input" 
	value="<?php echo isset($_POST['input']) ? $_POST['input'] : '' ?>">
	<input type="submit" name="ok" value="OK"><br>
	Price:
	<input type="submit" name="asc_pri" value="Tăng dần">
	<input type="submit" name="des_pri" value="Giảm dần"><br>
	Order:
	<input type="submit" name="asc_ord" value="Tăng dần">
	<input type="submit" name="des_ord" value="Giảm dần"><br>
	Tổng tiền:
	<input type="submit" name="asc_total" value="Tăng dần">
	<input type="submit" name="des_total" value="Giảm dần">
</form>

</body>
</html>