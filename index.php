<?php
class Price{
    public $cost;
    public $color;
    public function __construct($cost, $color){
        $this->cost = $cost;
        $this->color = $color;
    }
    public function sale($discount){
        return $this->cost - ($this->cost * ($discount /100));
         
    }
}
class UsaPrice extends Price{
    public $currency;
    public function __construct($cost, $color, $currency){
        $this->currency = $currency;
        parent::__construct($cost, $color);
    }
    public function new_price(){
        return round($this->cost / $this->currency, 2);
    }
}
$a = new Price(200, 'white');
$price_after_discount = $a->sale(10); // 180
$b = new UsaPrice(300, 'yellow', 88);
$b->new_price(); // 3,41

// Ex 6

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A(); // Создали экземпляр класса А
$a2 = new A(); // Создали еще один экземпляр класса А
$a1->foo(); // 1
$a2->foo(); // 2
$a1->foo(); // 3
$a2->foo(); // 4 Во всех случаях метод foo остается неизменным, не смотря на разные объекты

// Ex 6

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A(); // Создали экземпляр класса А
$b1 = new B(); // Создали экземпляр класса B, наследуемый от класса А
$a1->foo(); // 1 При наследовании классов создается новый метод foo (в классе В) и при
$b1->foo(); // 1 создании переменной $x - снова равна 0.
$a1->foo(); // 2
$b1->foo(); // 2

// Ex 7

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A; // Разницы в результате с 6-ым заданием я не заметил. При отсутствии аргументов
$b1 = new B; // в конструктор класса - круглые скобки после имени классов можно не ставить.
$a1->foo(); // 1
$b1->foo(); // 1
$a1->foo(); // 2
$b1->foo(); // 2