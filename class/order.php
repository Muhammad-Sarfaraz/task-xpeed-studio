<?php
require_once 'init.php';

class Order
{

    public $db;
    public $validation;

    public function __construct()
    {
        $this->db = new Database();
        $this->validation = new Validation();
    }

    public function insert()
    {
        $amount = $this->validation->checkNum($_POST['amount'], 'amount');
        $buyer = $this->validation->checkName($_POST['buyer'], 'buyer', 20);
        $receipt_id = $this->validation->checkOnlyText($_POST['receipt_id'], 'receipt_id', 20);
        $items = $this->validation->checkName($_POST['items'], 'items', 255);
        $email = $this->validation->checkEmail($_POST['email'], 'email');
        $city = $this->validation->checkOnlyTextWithSpace($_POST['city'], 'city', 20);
        $phone = $this->validation->checkNum($_POST['phone'], 'phone', 20);
        $entry_by = $this->validation->checkNum($_POST['entry_by'], 'entry_by');
        $note = $this->validation->checkLength($_POST['note'], 'note', 30);

        if (
            $phone['valid'] == false || $buyer['valid'] == false || $amount['valid'] == false ||
            $receipt_id['valid'] == false || $items['valid'] == false || $email['valid'] == false || $city['valid'] == false || $entry_by['valid'] == false || $note['valid'] == false
        ) {
            return [
                'amount' => $amount['valid'] !== true ? $amount['text'] : '',
                'buyer' => $buyer['valid'] !== true ? $buyer['text'] : '',
                'receipt_id' => $receipt_id['valid'] !== true ? $receipt_id['text'] : '',
                'items' => $items['valid'] !== true ? $items['text'] : '',
                'email' => $email['valid'] !== true ? $email['text'] : '',
                'city' => $city['valid'] !== true ? $city['text'] : '',
                'phone' => $phone['valid'] !== true ? $phone['text'] : '',
                'entry_by' => $entry_by['valid'] !== true ? $entry_by['text'] : '',
                'note' => $note['valid'] !== true ? $note['text'] : '',
            ];
            exit;
        } else {
            // var_dump($phone['text']);
            // exit;
            // return $phone['text'];
            $query = "INSERT INTO orders VALUES  (null, :amount,:buyer,:receipt_id,:items,:buyer_email,:buyer_ip,:note,:city, :phone,:entry_at,:entry_by)";
            $this->db->query($query);
            $this->db->bind('amount', $amount['text']);
            $this->db->bind('buyer', $buyer['text']);
            $this->db->bind('receipt_id', $receipt_id['text']);
            $this->db->bind('items', $items['text']);
            $this->db->bind('buyer_email', $email['text']);
            $this->db->bind('buyer_ip', getenv("REMOTE_ADDR"));
            $this->db->bind('note', $note['text']);
            $this->db->bind('city', $city['text']);
            $this->db->bind('phone', $phone['text']);
            $this->db->bind('entry_at', date("Y-m-d"));
            $this->db->bind('entry_by', $entry_by['text']);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function deleteEmployee($id)
    {
        $query = "DELETE FROM employee WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getEmployee($id)
    {
        $query = "SELECT * FROM employee WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->singleResult();
    }

    public function updateEmployee()
    {
        $name = $this->validation->checkName($_POST['name']);
        $gender = $_POST['gender'];
        $email = $this->validation->checkEmail($_POST['email']);
        $phone = $this->validation->checkNum($_POST['phone']);
        $address = $_POST['address'];
        $id = $_POST['id'];

        if (($name && $email && $phone) == 0) {
            return 0;
            exit;
        } else {
            $query = "UPDATE employee SET name = :name, gender = :gender, email = :email, phone = :phone, address = :address WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('name', $name);
            $this->db->bind('gender', $gender);
            $this->db->bind('email', $email);
            $this->db->bind('phone', $phone);
            $this->db->bind('address', $address);
            $this->db->bind('id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function searchEmployee()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM employee WHERE name LIKE :keyword OR gender LIKE :keyword OR email LIKE :keyword OR phone LIKE :keyword OR address LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultAll();
    }
}
