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

    public function checkOnlyText($text, $length)
    {
        $text = $this->testInput($text,);
        if (preg_match("/^s[a-z]*$/i", $text)) {
            if (strlen($text) >= $length) {
                return $text;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function checkName($name, $length)
    {
        $name = $this->testInput($name);
        if (preg_match("/^[a-zA-Z ]*$/", $name)) {
            if (strlen($name) >= $length) {
                return $name;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function checkNum($num)
    {
        if (is_numeric($num)) {
            return $num;
        } else {
            return 0;
        }
    }

    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else {
            return 0;
        }
    }
}
