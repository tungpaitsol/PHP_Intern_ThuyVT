<?php session_start();
if (isset($_GET['lang'])) {
	$_SESSION['lang']= $_GET['lang'];
}
class Language
{
	private $name;
	private $value;

	public function __construct(){}

	public function getValue(){
		return $this->value;
	}
}

class Singleton
{
	private static $instance;
	public static function getInstance($name,$value)
	{
		if (!self::$instance) {
			self::$instance = new Language($name,$value);
		}
		return self::$instance;
	}
}

$vi = Singleton::getInstance('vietnamese',LangContext::getContent('vi'));
$lang=$_SESSION['lang'];
$content=$vi->getValue();
echo "<pre>";
print_r($vi);

class LangContext
{
	public function getContent($lang){
		//Mở file chỉ để đọc, đặt con trỏ ở đầu file:
		$myfile = fopen('folder_lang/'.$lang.'.txt',"r") or die("Unable to open file!");
		$i=0;
		while(!feof($myfile)) //lặp tới khi hết file.
		{
			$l= fgets($myfile); //lấy dữ liệu ở dòng hiện tại của con trỏ.
			$s=strpos($l, "="); //xác định vị trí dấu "=".
			$key[$i]=substr( $l, 0, $s); //gán giá trị phía trước "=" vào phần tử của $key.
			$a=substr($l, $s+1, strlen($l)); //lấy giá trị phía sau "=".
			$value[$i]=str_replace('"', "", $a); //xóa dấu ".
			$i++;
		}
		//Tạo mảng sử dụng các giá trị từ mảng $key là các key và các giá trị từ mảng $value là các value tương ứng:
		$arr=array_combine($key,$value);
		return $arr;
		fclose($myfile);
	}
}
 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bài 2 OOP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="custom.css">
</head>
<body>
	<?php echo $_SESSION['lang']=='en' ? "Select language: " : "Lựa chọn ngôn ngữ: " ?>
	<br>
	<form class="form_lang" method='get' action=''>
		<select name='lang' onchange="handleSelect(this)" >
			<option value='en' <?php if(isset($_SESSION['lang'])&&$_SESSION['lang']=='en') echo "selected" ?> >English</option>
			<option value='vi' <?php if(isset($_SESSION['lang'])&&$_SESSION['lang']=='vi') echo "selected" ?> >Tiếng Việt</option>
		</select>
	</form>
	<form class="form_reg" method="post">
		<div class="container">
			<h1><?php echo $_SESSION['lang']=='en' ? "REGISTER" : "ĐĂNG KÝ" ?></h1>
			<p><?php echo $_SESSION['lang']=='en' ? "Creat your account. It's free and only takes a minute. " : "Tạo tài khoản của bạn. Miễn phí và chỉ mất một phút. " ?></p>
			<div class="name">
				<input class="col-md-6 cl1" type="text" value="<?php echo isset($_SESSION['lang'])?$content['firstname']:"" ?>"name="firstname">
				<input class="col-md-6 cl2" type="text" placeholder="<?php echo isset($_SESSION['lang'])?$content['lastname']:"" ?>" name="lastname">
			</div>
			<input class="col-md-12" type="text" placeholder="<?php echo isset($_SESSION['lang'])?$content['email']:"" ?>" name="email">
			<input class="col-md-12" type="password" placeholder="<?php echo isset($_SESSION['lang'])?$content['password']:"" ?>" name="password">
			<input class="col-md-12" type="password" placeholder="<?php echo isset($_SESSION['lang'])?$content['confirmpassword']:"" ?>" name="confirm">
			<input type="submit" value="<?php echo isset($_SESSION['lang'])?$content['registernow']:"" ?>" class="registerbtn">
		</div>
	</form>
</body>
</html>
<script type="text/javascript">
	function handleSelect(elm)
	{
		window.location.href = "OOP_Bai2.php?lang="+elm.value;
	}
</script>

