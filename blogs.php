<?php

include 'includes/conn.php';
include 'includes/header.php';
include 'includes/anon_header.php';

?>

<div class="c-home-container" style="min-height: 100vh;">

    <h1>Blogs</h1>

    <div class="cards">

        <?php
        $sql = "SELECT * FROM blogs";
        $query = $conn->query($sql);
        $i = 0;
        while ($row = $query->fetch_assoc()) {
            $title = substr($row["blog_title"], 0, 100);
            $desc = $row['blog_content'];
            $desc = strip_tags($row['blog_content']); // Remove HTML tags
            $desc = trim($desc); // Trim leading and trailing whitespace
            echo '
        <div class="card">
            <a href="read_blog.php?blog_id=' . $row['id'] . '" style="display: block ;height: 100%;">
                <div class="card-text">
                    <h3>' . $title . '</h3>
                    <div>'. substr($desc, 0,200) . '</div>
                </div>
            </a>
        </div>
        ';
        }
        ?>
    </div>

</div>



<?php include 'includes/anon_footer.php'; ?>