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
        $amount = $this->validation->checkNum($_POST['amount'], 'amount', 10);
        $buyer = $this->validation->checkName($_POST['buyer'], 'buyer', 20);
        $receipt_id = $this->validation->checkOnlyText($_POST['receipt_id'], 'receipt_id', 20);
        $items = $this->validation->checkName($_POST['items'], 'items', 255);
        $email = $this->validation->checkEmail($_POST['email'], 'email', 50);
        $city = $this->validation->checkOnlyTextWithSpace($_POST['city'], 'city', 20);
        $phone = $this->validation->checkNum($_POST['phone'], 'phone', 20);
        $entry_by = $this->validation->checkNum($_POST['entry_by'], 'entry_by', 10);
        $note = $this->validation->checkLength($_POST['note'], 'note', 30);

        if (
            $phone['valid'] == false || $buyer['valid'] == false || $amount['valid'] == false ||
            $receipt_id['valid'] == false || $items['valid'] == false || $email['valid'] == false || $city['valid'] == false || $entry_by['valid'] == false || $note['valid'] == false
        ) {
            return [
                'amount' => $amount['valid'] !== true ? [
                    'error' => $amount['error'],
                    'text' => $amount['text']
                ] : '',
                'buyer' => $buyer['valid'] !== true ?
                    [
                        'error' => $buyer['error'],
                        'text' => $buyer['text']
                    ]
                    : '',
                'receipt_id' => $receipt_id['valid'] !== true ?
                    [
                        'error' => $receipt_id['error'],
                        'text' => $receipt_id['text']
                    ]
                    : '',
                'items' => $items['valid'] !== true ?
                    [
                        'error' => $items['error'],
                        'text' => $items['text']
                    ]
                    : '',
                'email' => $email['valid'] !== true ?
                    [
                        'error' => $email['error'],
                        'text' => $email['text']
                    ]
                    : '',
                'city' => $city['valid'] !== true ?
                    [
                        'error' => $city['error'],
                        'text' => $city['text']
                    ]
                    : '',
                'phone' => $phone['valid'] !== true ?
                    [
                        'error' => $phone['error'],
                        'text' => $phone['text']
                    ]
                    : '',
                'entry_by' => $entry_by['valid'] !== true ?
                    [
                        'error' => $entry_by['error'],
                        'text' => $entry_by['text']
                    ]
                    : '',
                'note' => $note['valid'] !== true ?
                    [
                        'error' => $note['error'],
                        'text' => $note['text']
                    ]
                    : '',
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

    public function searchOrder($id)
    {
        $query = "SELECT * FROM orders WHERE entry_by = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->resultAll();
    }
}
