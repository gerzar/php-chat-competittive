<?php

/**
 *
 * Уважаемые участники чата! Объявляем мини-конкурс! Необходимо показать все свои знания,
 * умения и навыки при выполнении следующего тестового задания. На выполнение задания отводим неделю,
 * т.е. крайний срок сдачи следующее воскресенье - 1 мая. Работу можно выкладывать на https://www.online-ide.com/ или на ГитХаб.
 * Ревьювер - Олег Арестов. Победителю - скромный финансовый приз от нашего сообщества!
 * Задание:
 * Напишите программу, которая выводит на экран числа от 1 до 100. При этом вместо чисел, кратных трем,
 * программа должна выводить слово «Fizz», а вместо чисел, кратных пяти — слово «Buzz». Если число кратно и 3, и 5, то
 * программа должна выводить слово «FizzBuzz»
 *
 * Образец вывода:
 * 8
 * Fizz
 * Buzz
 * 11
 * Fizz
 * 13
 * 14
 * FizzBuzz
 *
 *
 * Уважаемый Олег, я был вашим учеником на курсе по PHP мне очень понравился ваш стиль преподавания, спасибо
 *
 *
 */

//Версия php 7.3

//идея заключается в том, чтобы можно было добавить сюда любые данные для замены числа т.е вместо
//Fizz Buzz любое значение, также можно добавить новые вариации проверок, не только на деление без остатка, но и другие варианты,
//например если число равно 23 то выводить какой-то текст или что угодно, для этого достаточно расширить функционал класса
//также можно добавить любой промежуток в котором нужно вывести числа


class Competitive
{

    private $bot_border;
    private $top_border;
    private $error = false;

    private $actions = [];

    private $result;


    public function setRange(int $bot_border, int $top_border): self
    {
        if ($bot_border > $top_border) {
            $this->error = true;
            return $this;
        }

        $this->bot_border = $bot_border;
        $this->top_border = $top_border;

        return $this;

    }

    /*Проверка делится ли число без остатка*/
    public function isModulo(int $check_number, string $message): self
    {
        if ($this->error) {
            return $this;
        }

        $this->actions[] =
            (object)[
                'action' => 'isModuloAction',
                'number' => $check_number,
                'message' => $message
            ];


        return $this;
    }

    /* сам метод по проверке и обработке */
    private function isModuloAction(int $check_number, int $checking_number, string $message)
    {

        if ($checking_number % $check_number === 0) {
            return $message;
        }

        return false;

    }

    private function set(int $checking_number): string
    {

        $result = '';

        foreach ($this->actions as $action) {

            $method = $action->action;
            if ( $checked_value =  $this->$method($action->number, $checking_number, $action->message) ) {
                $result .= $checked_value;
            }

        }

        return (( mb_strlen($result, 'UTF-8') === 0 ) ? (string)$checking_number : $result);

    }

    public function show(): string
    {
        if ($this->error) {
            return 'Error';
        }

        for ($i = $this->bot_border; $i < $this->top_border; $i++) {
            $this->result .= $this->set($i) . '<br>';
        }

        return $this->result;

    }


}


$competitive = new Competitive();


echo  $competitive->setRange(1, 100)
        ->isModulo(3, 'Fizz')
        ->isModulo(5, 'Buzz')
        ->show();




