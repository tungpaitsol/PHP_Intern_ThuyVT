<?php session_start();
if (isset($_GET['lang'])) {
	$_SESSION['lang']= $_GET['lang'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Test bài 2 OOP</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php echo $_SESSION['lang']=='en' ? "Select language: " : "Lựa chọn ngôn ngữ: " ?>
	<br>
	<form method='get' action=''>
		<select name='lang' onchange="handleSelect(this)" >
			<option value='en' <?php if(isset($_SESSION['lang'])&&$_SESSION['lang']=='en') echo "selected" ?> >English</option>
			<option value='vi' <?php if(isset($_SESSION['lang'])&&$_SESSION['lang']=='vi') echo "selected" ?> >Tiếng Việt</option>
		</select>
	</form>
</body>
</html>
<script type="text/javascript">
	function handleSelect(elm)
	{
		window.location.href = "OOP_Bai2.php?lang="+elm.value;
	}
</script>
<?php 
class Language
{
	private $name;
	private $value;
	function __construct($name, $value)
	{
		$this->name = $name;
		$this->value = $value;
	}
	public function seValue($value){
		$this->value = $value;
	}
	public function getValue(){
		return $this->value;
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
	}
}
$language = array(
	'en' => new Language("english",LangContext::getContent('en')),
	'vi' => new Language("vietnamese",LangContext::getContent('vi'))
);
$lang=$_SESSION['lang'];
$content = $language[$lang]->getValue();
foreach ($content as $value) {
	echo "<pre>".$value;
}
?>
