<?php // logout.php
    session_start();
    session_destroy();
    echo json_encode(['success' => true]);
    header("Location: index.html");
    exit();
?>