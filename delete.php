<?php

session_start();

if (isset($_SESSION['user']) && isset($_GET['id'])) {
    require_once './controllers/badges.php'; 

    $badgeId = intval($_GET['id']);
    if (deleteBadgeById($badgeId)) {
        echo "Badge deleted successfully.";
        header('Location: issued.php');
    } else {
        echo "Failed to delete badge.";
    }
} else {
    echo "Unauthorized access.";
}

?>