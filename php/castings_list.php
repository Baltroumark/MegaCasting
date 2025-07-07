<?php
session_start();
require 'db.php';

$stmt = $pdo->query("
    SELECT castings.*, users.email AS director 
    FROM castings 
    JOIN users ON castings.user_id = users.id 
    ORDER BY date_debut DESC
");
$castings = $stmt->fetchAll();

include '../views/castings_list.php';
?>
