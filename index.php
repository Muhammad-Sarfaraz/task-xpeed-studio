
<?php
$page_title = 'List of Employee';
require_once 'init.php';

$db = new Database();

$query = "SELECT * FROM employee";
$db->query($query);
$data = $db->resultAll();

print_r($data);

if (isset($_POST['search'])) {
    $data = $employee->searchEmployee();
}
?>