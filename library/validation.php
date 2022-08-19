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
                    'text'  => $text
                ];
            } else {
                return [
                    'valid' => false,
                    'error' => 'Please provide a valid ' . $name . ' with only containing text Max: ' . $length,
                    'text'  => $text
                ];
            }
        } else {
            return [
                'valid' => false,
                'error' => 'Please provide a valid ' . $name . ' with only containing text Max: ' . $length,
                'text'  => $text
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
                    'text'  => $text
                ];
            } else {
                return [
                    'valid' => false,
                    'error' => 'Please provide a valid ' . $name . ' Max: ' . $length,
                    'text'  => $text
                ];
            }
        } else {
            return [
                'valid' => false,
                'error' => 'Please provide a valid ' . $name . ' Max: ' . $length,
                'text'  => $text
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
                    'text'  => $text
                ];
            } else {
                return [
                    'valid' => false,
                    'error' => 'Please provide a valid ' . $name . ' Max: ' . $length,
                    'text'  => $text
                ];
            }
        } else {
            return [
                'valid' => false,
                'error' => 'Please provide a valid ' . $name . ' Max: ' . $length,
                'text'  => $text
            ];
        }
    }

    public function checkNum($num, $name, $length)
    {
        if (is_numeric($num)) {
            return [
                'valid' => true,
                'text'  => $num
            ];
        } else {
            return [
                'valid' => false,
                'error' => 'Please provide a valid ' . $name . ' Max Digits: ' . $length,
                'text'  => $num
            ];
        }
    }

    public function checkEmail($email, $name, $length)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'valid' => true,
                'text'  => $email
            ];
        } else {
            return [
                'valid' => false,
                'error' => 'Please provide a valid ' . $name . ' Max: ' . $length,
                'text'  => $email
            ];
        }
    }

    public function checkLength($text, $name, $length)
    {
        if (str_word_count($text) <= $length) {
            return [
                'valid' => true,
                'text'  => $text
            ];
        } else {
            return [
                'valid' => false,
                'error' => 'Please provide a valid ' . $name . ' Max: ' . $length,
                'text'  => $text
            ];
        }
    }
}
