<?php
class Language
{
	private $code;
	private $name;
	private $value;

	public function __construct($code, $name, $value){
		$this->code = $code;
		$this->name = $name;
		$this->value = $value;
	}

	public function getCode(){
		return $this->code;
	}
	public function getName(){
		return $this->name;
	}
	public function getValue(){
		return $this->value;
	}

}

class Singleton
{
	private static $instance;
	public static function getInstance($code, $name, $value)
	{
		if (!self::$instance) {
			self::$instance = new Language($code, $name, $value);
		}
		return self::$instance;
	}
}

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
	public function getValue($lang,$pro)
	{
		if($lang=='en')
			$name='English';
		$name='Vietnamese';
		$cont = Singleton::getInstance($lang, $name, LangContext::getContent($lang));
		if(isset($cont->getValue()[$pro])){
			return $cont->getValue()[$pro];
		}
		return $pro;
	}
}

session_start();
$_SESSION['lang']='en';
if (isset($_GET['lang'])) {
	$_SESSION['lang']= $_GET['lang'];
}
$lang=$_SESSION['lang'];
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
<input class="col-md-6 cl1" type="text" placeholder="<?php echo LangContext::getValue($lang,'firstname') ?>"name="firstname">
<input class="col-md-6 cl2" type="text" placeholder="<?php echo LangContext::getValue($lang,'lastname') ?>" name="lastname">
</div>
<input class="col-md-12" type="text" placeholder="<?php echo LangContext::getValue($lang,'email') ?>" name="email">
<input class="col-md-12" type="password" placeholder="<?php echo LangContext::getValue($lang,'password') ?>" name="password">
<input class="col-md-12" type="password" placeholder="<?php echo LangContext::getValue($lang,'confirmpassword') ?>" name="confirm">
<input type="submit" value="<?php echo LangContext::getValue($lang,'registernow') ?>" class="registerbtn">
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

