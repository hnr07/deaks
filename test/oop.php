<?//define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("OOP");
?>
<?
// class MyClass
// {
  // public $prop1 = "Свойство класса 1 ";
  // public $prop2 = "Свойство класса 2 ";
  
  // private $name= "ddd";
  
  // public function __construct(){
      
  
  // }
  
    // public function setProperty1($newval)
    // {
        // $this->prop1 = $newval."123<br />";
    // }

    // public function getProperty1()
    // {
        // return $this->prop1 . "<br />";
    // }
      // public function setProperty2($newval)
    // {
        // $this->prop2 = $newval."456";
    // }

    // public function getProperty2()
    // {
        // return $this->prop2 . "<br />";
    // }
	// public function naming(){
		// $this -> name="aaa<br />";
		// echo $this -> name;
	// }
// }

// $obj = new MyClass;
//var_dump($obj);

// echo $obj->prop1." ".$obj->prop2;
 ?>
 <br />
 <?
// echo $obj->prop1." ".$obj->getProperty1();

// $obj->setProperty2("ssssssssssss");

//echo $obj->prop1." ".$obj->getProperty2();

//var_dump($obj instanceof MyClass);

// $obj -> naming();
//echo $obj -> name;


class User {
	public $name="ИМЯ";
	public $password="Пароль";
	public $email="email";
	public $city="Город";
	private static $name2;
	public static function setName($name1)
	{
		self::$name2=$name1;
	}
	public static function getName ()
	{
		return self::$name2;
	}
	function __construct($name, $password, $email, $city) {
		$this->name=$name;
		$this->password=$password;
		$this->email=$email;
		$this->city=$city;
	}
	// public function getName() {
		// echo $this->name;
		// $this->test();
	// }
	public function test() {
		echo "test";
	}
	public function getInfo() {
		$information= "{$this->name}"."{$this->password}"."{$this->email}"."{$this->city}";
		return $information;
	}
	
	public function Hello() {
		echo "<br />Hello {$this->name}";
	}
	
	
}


$admin=new User();
echo $admin->name;
$admin -> surname="yyyyyyyyyyyy";
echo $admin->surname;


  $user1=new User("Ivan ","123456 ", "mail@mail.ru ", "Perm ");

 // $user1->getName();
 
 // $user2=new User("","", "", "");
  // $user2->name="Petr";
  // $user2->getName();
  

  User::setName("egor");
  echo User::getName();
//var_dump($user1);
// echo "<pre>";print_r($user1);echo "</pre>";
 echo $user1->getInfo();


class Moderator extends User {
	public $info;
	public $rights;	
	
	
	
}

$moder= new Moderator("Andre ","555555 ", "moder@mail.ru ", "Rostov ");
echo $moder->getInfo();

// class Des {
	// function __construct()
	// {
		// print "Конструктор ";
		// $this->name="Des";
	// }
	// function __destruct() 
	// {
		// print " Из памяти "."{$this->name}";
	// }
// }
// $obja = new Des();

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>