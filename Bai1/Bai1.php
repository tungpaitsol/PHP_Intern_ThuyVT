<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bài 1</title>
</head>
<body>
	<h3>Giải phương trình bậc hai</h3>
    <form method="post" action="">
        <input type="text" style="width: 30px" name="a" autofocus pattern="[0-9]?[0-9]" value="<?php echo isset($_POST['a']) ? $_POST['a'] : '' ?>"/>x<sup>2</sup>
        +
        <input type="text" style="width: 30px" name="b" autofocus pattern="[0-9]?[0-9]" value="<?php echo isset($_POST['b']) ? $_POST['b'] : '' ?>"/>x
        + 
        <input type="text" style="width: 30px" name="c" autofocus pattern="[0-9]?[0-9]" value="<?php echo isset($_POST['c']) ? $_POST['c'] : '' ?>"/>
        = 0
        <br/><br/>
        <input type="submit" name="gptb2" value="Tính" />
    </form>
    <?php
	$result='';
	if(isset($_POST['gptb2']))
	{
		$a=isset($_POST['a']) ? $_POST['a']:'';
		$b=isset($_POST['b']) ? $_POST['b']:'';
		$c=isset($_POST['c']) ? $_POST['c']:'';
		if(empty($a)||empty($b)||empty($c))
			echo"Bạn chưa nhập đủ dữ liệu.";
		else{
			$delta=($b*$b) - (4*$a*$c);
			if($a==0 && $b==0 && $c==0)
				$result="Phương trình có vô số nghiệm.";
			else if($a==0 && $b==0)
				$result="Phương trình vô nghiệm.";
			else if($a==0)
				$result="Phương trình có nghiệm duy nhất: x=".(-$c/$b);
			else if($delta<0)
				$result="Phương trình vô nghiệm.";
			else if($delta==0)
				$result="Phương trình có nghiệm kép: x1=x2=".(-$b/2*$a);
			else{
				$result="Phương trình có 2 nghiệm phân biệt: x1= ".((-$b+sqrt($delta))/(2*$a)).", x2= ".((-$b-sqrt($delta))/(2*$a));
			}
		}
	}
    echo $result; 
    ?>
</body>
</html>