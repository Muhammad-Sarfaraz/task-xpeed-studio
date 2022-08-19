<?php

class Validation
{

    public function testInput($data)
    {
        $result = trim($data);
        $result = htmlspecialchars($result);
        $result = stripslashes($result);
        return $result;
    }

    public function checkOnlyText($text, $name, $length)
    {
        $text = $this->testInput($text,);
        if (ctype_alpha($text)) {
            if (strlen($text) <= $length) {
                return [
                    'valid' => true,
                    'text' => $text
                ];
            } else {
                return [
                    'valid' => false,
                    'text' => 'Please provide a valid' . $name
                ];
            }
        } else {
            return [
                'valid' => false,
                'text' => 'Please provide a valid ' . $name . ' Max: ' . $length
            ];
        }
    }

    public function checkOnlyTextWithSpace($text, $name, $length)
    {
        $text = $this->testInput($text);
        if (preg_match("/^[a-zA-Z\s]+$/", $text)) {
            if (strlen($text) <= $length) {
                return  [
                    'valid' => true,
                    'text' => $text
                ];
            } else {
                return [
                    'valid' => false,
                    'text' => 'Please provide a valid text.'
                ];
            }
        } else {
            return [
                'valid' => false,
                'text' =>  'Please provide a valid ' . $name . ' Max: ' . $length
            ];
        }
    }

    public function checkName($text, $name, $length)
    {
        $text = $this->testInput($text);
        if (preg_match("/^[a-zA-Z ]*$/", $text)) {
            if (strlen($text) <= $length) {
                return  [
                    'valid' => true,
                    'text' => $text
                ];
            } else {
                return [
                    'valid' => false,
                    'text' => 'Please provide a valid text.'
                ];
            }
        } else {
            return [
                'valid' => false,
                'text' =>  'Please provide a valid ' . $name . ' Max: ' . $length
            ];
        }
    }

    public function checkNum($num)
    {
        if (is_numeric($num)) {
            return [
                'valid' => true,
                'text' => $num
            ];
        } else {
            return [
                'valid' => false,
                'text' => 'Please provide a valid number.'
            ];
        }
    }

    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'valid' => true,
                'text' => $email
            ];
        } else {
            return [
                'valid' => false,
                'text' => 'Please provide a valid email.'
            ];
        }
    }

    public function checkLength($text, $name, $length)
    {
        if (str_word_count($text) <= $length) {
            return [
                'valid' => true,
                'text' => $text
            ];
        } else {
            return [
                'valid' => false,
                'text' =>  'Please provide a valid ' . $name . ' Max: ' . $length
            ];
        }
    }
}
