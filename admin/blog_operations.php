<?php
include 'includes/session.php';


if (isset($_POST['add'])) {
    // $blog_title = $_POST['blog_title'];
    // $blog_content = $_POST['blog_content'];

    // $sql = "INSERT INTO `blogs`(`blog_title`, `blog_content`) VALUES ('$blog_title','$blog_content')";
    // if ($conn->query($sql)) {
    //     $_SESSION['success'] = 'Blog added Successfully';
    // } else {
    //     $_SESSION['error'] = $conn->error;
    // }

    require 'includes/pdo_conn.php';
    $blog_title = $_POST['blog_title'];
    $blog_content = $_POST['blog_content'];

    // Create a prepared statement
    $stmt = $db->prepare("INSERT INTO blogs (blog_title, blog_content) VALUES (?, ?)");


    if ($stmt) {
        if ($stmt->execute([$blog_title, $blog_content])) {
            $_SESSION['success'] = 'Blog added Successfully';
        } else {
            $_SESSION['error'] = $stmt->errorInfo();
        }
    } else {
        $_SESSION['error'] = 'Failed to prepare the statement';
    }
}


if (isset($_POST['delete'])) {
    $id = $_POST['delete_id'];

    $sql = "DELETE FROM blogs WHERE id = '$id'";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Blog deleted successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: blogs_admin.php');
