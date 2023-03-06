<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php

if (!isset($_SESSION['password']) || (isset($_SESSION['password']) && $_SESSION['password'] != md5('T3sB4Y4rN0X3nd1t'))) {
    header("Location:" . base_url());
  }

$dbconn = getDBConn();

if (isset($_POST['submit'])) {

    $check = getimagesize($_FILES["file"]["tmp_name"]);
    $check2 = getimagesize($_FILES["file2"]["tmp_name"]);
    if ($check !== false && $check2 !== false) {

        $id = $_GET['id'];
        $content = $_POST['content'];
        $title = $_POST['title'];

        $name = $_FILES["file"]["name"];
        $name2 = $_FILES["file2"]["name"];
        $target_dir = getcwd() . '/blog/uploads/';
        $target_file = $target_dir . $_FILES["file"]["name"];
        $target_file2 = $target_dir . $_FILES["file2"]["name"];

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg", "jpeg", "png", "gif");

        // Check extension
        if (in_array($imageFileType, $extensions_arr) && in_array($imageFileType2, $extensions_arr)) {

            //insert record
            //$query = $dbconn->prepare("INSERT INTO BLOG_POST (IMAGE, TITLE, CONTENT, DATE) VALUES (?, ?, ?, NOW())");
            $query = $dbconn->prepare("UPDATE BLOG_POST SET IMAGE = ?, IMAGE2 = ?, TITLE = ?, CONTENT = ?, DATE = NOW() WHERE ID = ?");
            $query->bind_param("ssssi", $name, $name2, $title, $content, $id);
            $query->execute();
            $query->close();

            // Upload file
            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name) && move_uploaded_file($_FILES['file2']['tmp_name'], $target_dir . $name2)) {

                //select blog post id
                $query = $dbconn->set_charset("utf8");
                $query = $dbconn->prepare("SELECT * FROM BLOG_POST ORDER BY DATE DESC LIMIT 1");
                $query->execute();
                $blog_id = $query->get_result()->fetch_assoc();
                $query->close();

                $query1 = $dbconn->prepare("DELETE FROM BLOG_TAG WHERE BLOG_ID = ?");
                $query1->bind_param("i", $_GET['id']);
                $query1->execute();
                $query1->close();

                $tags = $_POST['tags'];
                foreach ($tags as $tag => $value) {
                    //insert blog tag
                    //$query = $dbconn->prepare("INSERT INTO BLOG_TAG (BLOG_ID, TAG) VALUES (?, ?)");

                    $query2 = $dbconn->prepare("INSERT INTO BLOG_TAG (BLOG_ID, TAG) VALUES (?, ?)");
                    $query2->bind_param("is", $_GET['id'], $value);
                    $query2->execute();
                    $query2->close();
                }

                header('Location: ' . base_url() . 'blog-index.php');
            } else {
                echo ("<script>alert('Upload failed!');</script>");
            }
        }
    } else {
        echo ("<script>alert('Error!');</script>");
        header('Location: ' . base_url() . 'blog-post-new.php');
    }
}


?>

<style>
    .editor-body {
        margin-top: 8rem;
        margin-bottom: 5rem;
    }

    @media screen and (max-width:992px) {
        .editor-body {
            margin-top: 10rem;
        }
    }

    .blog {
        justify-content: space-between;
        width: 100%;
        margin: .5rem;
    }

    .btn-green {
        background-color: #01686d;
        color: white;
    }

    @media screen and (min-width:992px) {
        .modal-dialog {
            max-width: 40%;
        }
    }
</style>

<body>
    <div class="container-fluid editor-body">
        <div class="row">
            <div class="col-md-8">
                <h1>Edit blog post</h1>

                <div id="editor-container" style="height: 600px;"></div><br>
                <button type="button" class="btn btn-green" id="submit" data-toggle="modal" data-target="#exampleModal" style="float:right;">
                    Submit
                </button>
            </div>

        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <?php
        $query2 = $dbconn->set_charset("utf8");
        $query2 = $dbconn->prepare('SELECT CONTENT, TITLE FROM BLOG_POST WHERE ID = ?');
        $query2->bind_param('i', $_GET['id']);
        $query2->execute();
        $blog_post = $query2->get_result()->fetch_assoc();
        $query2->close();

        $blog_content = $blog_post['CONTENT'];
        $blog_title = $blog_post['TITLE'];

        echo "<script>";
        // echo "alert('" . $blog_content ."');";
        echo "$(document).ready(function(){";
        // echo "$('#file').val('" . $blog_post['IMAGE'] . "');";
        // echo '$(".ql-editor").html(\'' . $blog_content . '\');';
        // echo 'quill.root.innerHTML = \'' . $blog_content . '\';';
        // echo "var editor = document.getElementsByClassName('ql-editor');";
        // echo "editor[0].innerHTML = '". $blog_content ."';";
        // echo "var value = '" . $blog_content . "';";
        // echo "var delta = quill.clipboard.convert(value);";
        // echo "quill.setContents(delta);";
        echo '$("#title").val("' . $blog_title . '");';
        echo "});";
        echo "</script>";
        ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Edit blog post</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row my-3">
                                <div class="col-md-4">
                                    Post title :
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="title">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-4">
                                    Post thumbnail image :
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="file" id="file">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-4">
                                    Post image :
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="file2" id="file2">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-4">
                                    Post label :
                                </div>
                                <div class="col-md-8">
                                    <input type="checkbox" id="tag1" name="tags[]" value="Developer">
                                    <label for="tag1"> Developer</label><br>

                                    <input type="checkbox" id="tag2" name="tags[]" value="Business">
                                    <label for="tag2"> Business</label><br>

                                    <input type="checkbox" id="tag3" name="tags[]" value="Product">
                                    <label for="tag3"> Product</label><br>

                                    <input type="checkbox" id="tag4" name="tags[]" value="Technology">
                                    <label for="tag4"> Technology</label><br>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="content" name="content" value="">
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-green" type="submit" value="Submit" name="submit" style="float: right;">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

<!-- Initialize Quill editor -->
<script>
    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: [
                [{
                    'font': []
                }],
                [{
                    header: [1, 2, 3, 4, 5, 6, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }],
                [{
                    'header': 1
                }, {
                    'header': 2
                }],
                ['blockquote', 'code-block'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'direction': 'rtl'
                }, {
                    'align': []
                }],
                ['link', 'image', 'video', 'formula'],
                ['clean']
            ]
        },
        placeholder: 'Compose an epic...',
        theme: 'snow' // or 'bubble'
    });

    // quill.clipboard.dangerouslyPasteHTML('<?php //echo $blog_content; ?>');

    var value = '<?php echo $blog_content ?>';
    var delta = quill.clipboard.convert(value);
    quill.setContents(delta, 'silent');

    $("#submit").click(function() {
        var content = $(".ql-editor").html();
        $('#content').val(content);
    });
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>