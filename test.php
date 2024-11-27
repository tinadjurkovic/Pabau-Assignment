<?php
require_once 'config/database.php';

$query = $db->query("SELECT * FROM employees");
$employees = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($employees as $employee) {
    echo $employee['firstname'] . ' ' . $employee['lastname'] . '<br>';
}
