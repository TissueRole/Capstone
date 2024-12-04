<?php
session_start();
include "../connection.php";

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header("Location: forum.php");
    exit;
}

if (isset($_GET['id'])) {
    $question_id = intval($_GET['id']);

    $delete_replies = $conn->prepare("DELETE FROM reply WHERE question_id = ?");
    $delete_replies->bind_param("i", $question_id);
    $delete_replies->execute();

    $delete_question = $conn->prepare("DELETE FROM questions WHERE question_id = ?");
    $delete_question->bind_param("i", $question_id);
    $delete_question->execute();

    header("Location: adminpage.php");
    exit;
} else {
    echo "No question ID provided.";
}
?>
