<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Include Quill.js -->
<!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> -->

<style>
    img {
        width: 400px;
        height: 400px;
    }
</style>

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
                                        <form class="form-horizontal" id="add-blog-form" method="POST" action="blog_operations.php" enctype="multipart/form-data" onsubmit="updateBlogContent();">
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
                                            $desc = htmlspecialchars($desc, ENT_QUOTES, 'UTF-8');
                                            $desc = substr($desc, 0, 20);
                                            echo "
                        <tr>
                          <td>" . ++$i . "</td>
                          <td>" . $row['blog_title'] . "</td>
                          <td>" . htmlspecialchars_decode($desc) . "</td>
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

    <!-- <script>
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
                // 'image',
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
        });
    </script> -->

    <link rel="stylesheet" href="https://richtexteditor.com/richtexteditor/rte_theme_default.css" />
    <script type="text/javascript" src="https://richtexteditor.com/richtexteditor/rte.js"></script>
    <script type="text/javascript" src='https://richtexteditor.com/richtexteditor/plugins/all_plugins.js'></script>

    <script>
        var editor1 = new RichTextEditor("#editor-container");

        // Function to update the content of the 'blog_content' input field
        function updateBlogContent() {
            var content = editor1.getHTMLCode();
            document.getElementById('blog_content').value = content;
            return true; // Allow the form submission to proceed
        }
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