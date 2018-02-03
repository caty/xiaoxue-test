<?php
namespace Math;

class Question
{
    const TYPE_ADD     = 1;
    const TYPE_SUB     = 2;
    const TYPE_ADD_SUB = 3;

    private $range = 0;
    private $type  = 0;

    public function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();

        $method = 'construct'. $i;
        if (method_exists($this, $method)) {
            call_user_func_array(array($this, $method), $a);
        }
    }

    private function construct1($range)
    {
        $this->range = intval($range);
    }

    private function construct2($range, $type)
    {
        $this->construct1($range);
        $this->type  = $type;
    }

    public function generate()
    {
        $number1 = mt_rand(1, $this->range);
        $number2 = mt_rand(2, $this->range);

        if ($this->type === Question::TYPE_ADD_SUB) {
            $type = mt_rand() % 2 ? Question::TYPE_ADD : Question::TYPE_SUB;
        } else {
            $type = $this->type;
        }

        if ($type === Question::TYPE_SUB) {
            if ($number1 < $number2) {
                // 交换
                $temp    = $number1;
                $number1 = $number2;
                $number2 = $temp;
            }
        }

        $op = '';
        switch ($type) {
            case Question::TYPE_ADD:
                $op = '+';
                break;
            case Question::TYPE_SUB:
                $op = '-';
                break;
        }

        $text   = array();
        $text[] = $number1;
        $text[] = $op;
        $text[] = $number2;
        $text[] = '=';

        return join('', $text);
    }
}
