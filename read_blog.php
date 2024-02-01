<?php

include 'includes/conn.php';
include 'includes/header.php';
include 'includes/anon_header.php';

?>

<div class="c-container box">

    <?php

    $blog_id = $_GET["blog_id"];

    if (empty($blog_id)) {
        echo '<h1>Blog not found</h1>';
    }

    $sql = "SELECT * FROM blogs WHERE id='$blog_id'";
    $query = $conn->query($sql);
    $i = 0;
    while ($row = $query->fetch_assoc()) {
        $desc = $row['blog_content'];
        $desc = htmlspecialchars($desc, ENT_QUOTES, 'UTF-8');

        echo '
            <div class="card-text">
                <h1>' . $row['blog_title'] . '</h1>
                <div>' . htmlspecialchars_decode($desc) . '</div>
            </div>
        ';
    }
    ?>

</div>


<script>
    // Select all images with src attributes starting with "data:image/"
    const images = document.querySelectorAll('img[src^="data:image/"]');

    // Set the width and height for each selected image
    images.forEach(image => {
        image.style.width = '400px';
        image.style.height = '400px';
    });
</script>

<?php include 'includes/anon_footer.php'; ?>