<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Blogs List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Candidates</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">



                <?php
                if (isset($_SESSION['error'])) {
                    echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
                    unset($_SESSION['success']);
                }
                ?>




                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">

                                <div class="box m-2 with-border">
                                    <div class="box-header">
                                        Add New Blog
                                    </div>
                                    <div class="box-body">
                                        <form class="form-horizontal" method="POST" action="blog_operations.php" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="blog_title" class="col-sm-12">Blog Title</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="blog_title" name="blog_title" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="blog_content" class="col-sm-12">Blog Description</label>
                                                <div class="col-sm-12">
                                                    <div id="editor-container" style="width: 100%; height: 300px;"></div>
                                                    <input type="hidden" id="blog_content" name="blog_content">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="add"><i class="fa fa-save"></i> Save</button>
                                        </form>
                                    </div>
                                </div>


                            </div>

                            <div class="box-header with-border">
                                Blogs List
                            </div>

                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Blog Title</th>
                                            <th>Desc</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM blogs";
                                        $query = $conn->query($sql);
                                        $i = 0;
                                        while ($row = $query->fetch_assoc()) {
                                            $desc = $row['blog_content'];
                                            $desc = strip_tags($row['blog_content']); // Remove HTML tags
                                            $desc = trim($desc); // Trim leading and trailing whitespace

                                            echo "
                                                <tr>
                                                <td>" . ++$i . "</td>
                                                <td>" . $row['blog_title'] . "</td>
                                                <td>" . substr($desc, 0,100) . "</td>
                                                <td>
                                                    <a href='/votesystem/read_blog.php?blog_id=" . $row["id"] . "' class='btn btn-info btn-sm' target='_blank'><i class='fa fa-search'></i> View</a>
                                                    <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-trash'></i> Delete</button>
                                                </td>
                                                </tr>
                                            ";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include 'includes/footer.php'; ?>

        <!-- Delete -->
        <div class="modal fade" id="delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>Deleting...</b></h4>
                    </div>
                    <form class="form-horizontal" method="POST" action="blog_operations.php">
                        <div class="modal-body">
                            <input type="hidden" id="delete_id" name="delete_id">
                            <div class="text-center">
                                <p>DELETE Blog</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                            <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <?php include 'includes/scripts.php'; ?>
    <?php
    //  include 'includes/candidates_modal.php'; 
    ?>

    <script>
        var toolbarOptions = [
            [{
                'header': '1'
            }, {
                'header': '2'
            }, {
                'font': []
            }],
            [{
                size: []
            }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote'],
            [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                },
                {
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }
            ],
            [
                'link',
                'image',
                // 'video',
            ],
            ['clean'],
        ];

        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: toolbarOptions,
                clipboard: {
                    // toggle to add extra line breaks when pasting HTML:
                    matchVisual: false,
                }
            },

            theme: 'snow'
        });

        // Synchronize the Quill content with the hidden textarea
        quill.on('text-change', function() {
            var htmlContent = quill.root.innerHTML;
            document.getElementById('blog_content').value = htmlContent;

            // Select all images with src attributes starting with "data:image/"
            const images = document.querySelectorAll('img[src^="data:image/"]');
            // Set the width and height for each selected image
            images.forEach(image => {
                image.style.width = '400px';
                image.style.height = '400px';
            });

        });
    </script>


    <script>
        $(function() {

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                $('#delete').modal('show');
                var id = $(this).data('id');
                $('#delete_id').val(id);
                // getRow(id);
            });


        });
    </script>


</body>

</html>