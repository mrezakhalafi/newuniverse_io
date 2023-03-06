<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 6;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

?>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['password']) || (isset($_SESSION['password']) && $_SESSION['password'] != md5('T3sB4Y4rN0X3nd1t'))) {
  header("Location:" . base_url());
}

$str_tags = "SELECT * FROM BLOG_TAGLIST";
$query = $dbconn->prepare($str_tags);
$query->execute();
$tags_result = $query->get_result();
$query->close();

$tags_arr = array();
while($tag = $tags_result->fetch_assoc()) {
  $tags_arr[] = $tag;
}

// echo "<pre>";
// print_r($tags_arr);
// echo "</pre>";

if (isset($_POST['submit'])) {

  $check = getimagesize($_FILES["file"]["tmp_name"]);
  $check2 = getimagesize($_FILES["file2"]["tmp_name"]);
  if ($check !== false && $check2 !== false) {

    $dbconn = getDBConn();
    $content = $_POST['content'];
    $title = $_POST['title'];
    $url = $_POST["url"];
    $url2 = $_POST["url2"];
    $url3 = $_POST["url3"];

    $name = $_FILES["file"]["name"];
    $name2 = $_FILES["file2"]["name"];
    $target_dir = getcwd() . '/blog/uploads/';
    $target_file = $target_dir . $_FILES["file"]["name"];
    $target_file2 = $target_dir . $_FILES["file2"]["name"];

    $milliseconds = floor(microtime(true) * 1000);
    $bytes = random_bytes(3);
    $hexbytes = bin2hex($bytes);
    $post_id = $milliseconds . $hexbytes;

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
    if (in_array($imageFileType, $extensions_arr) && in_array($imageFileType2, $extensions_arr)) {

      

      // Upload file
      if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name) && move_uploaded_file($_FILES['file2']['tmp_name'], $target_dir . $name2)) {
        
        //insert record
        $query = $dbconn->prepare("INSERT INTO BLOG_POST (ID, IMAGE, IMAGE2, TITLE, CONTENT, URL, URL2, URL3, DATE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $query->bind_param("ssssssss", $post_id, $name, $name2, $title, $content, $url, $url2, $url3);
        $query->execute();
        $blog_id = $query->insert_id;
        $query->close();

        // insert tags
        $tags = $_POST['tags'];
        $sql = "INSERT INTO BLOG_TAG (BLOG_ID, TAG) VALUES ('$post_id', '$tags')";
        $query = $dbconn->prepare($sql);
        // $query->bind_param("iss", $blog_id['ID'], $value, $value_id);
        $query->execute();
        $query->close();

        // print_r($tags);
        // for ($i = 0; $i < count($tags); $i++) {
        //   //insert blog tag
        //   $sql = "INSERT INTO BLOG_TAG (BLOG_ID, TAG, TAG_ID) VALUES ($blog_id, '$value', '$value_id')";
        //   $query = $dbconn->prepare($sql);
        //   // $query->bind_param("iss", $blog_id['ID'], $value, $value_id);
        //   $query->execute();
        //   $query->close();
        // }

        // header('Location: ' . base_url() . 'blog-index.php');
      } else {
        // echo ("<script>alert('Upload failed!');</script>");
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
</head>

<body>
  <div class="container-fluid editor-body">
    <div class="row">
      <div class="col-md-8">
        <h1>Add new blog post</h1>

        <div id="editor-container" style="height: 600px;"></div><br>
        <button type="button" class="btn btn-green" id="submit" data-toggle="modal" data-target="#exampleModal" style="float:right;">
          Submit
        </button>
      </div>

    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" enctype="multipart/form-data">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Submit new blog post</b></h5>
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
                  URL (optional) :
                </div>
                <div class="col-md-8">
                  <input type="text" name="url">
                </div>
              </div>
              <div class="row my-3">
                <div class="col-md-4">
                  URL 2 (optional) :
                </div>
                <div class="col-md-8">
                  <input type="text" name="url2">
                </div>
              </div>
              <div class="row my-3">
                <div class="col-md-4">
                  URL 3 (optional) :
                </div>
                <div class="col-md-8">
                  <input type="text" name="url3">
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
                  Post tags :
                </div>
                <div class="col-md-8">
                  <!-- <input type="checkbox" id="tag1" name="tags[]" value="Developer">
                  <label for="tag1"> Developer</label><br>

                  <input type="checkbox" id="tag2" name="tags[]" value="Business">
                  <label for="tag2"> Business</label><br>

                  <input type="checkbox" id="tag3" name="tags[]" value="Product">
                  <label for="tag3"> Product</label><br>

                  <input type="checkbox" id="tag4" name="tags[]" value="Technology">
                  <label for="tag4"> Technology</label><br> -->
                  <?php 
                  
                    foreach($tags_arr as $tag) {
                      $tag_id = $tag["ID"];
                      $tag_name = $tag["TAG"];
                      $tag_name_id = $tag["TAG_ID"];
                      echo '<input type="radio" id="tag-'.$tag_id.'" name="tags" value="'.$tag_id.'">';
                      echo '<label for="tag-'.$tag_id.'"> '.$tag_name.'</label><br>';
                    }
                  
                  ?>
                </div>
              </div>
            </div>

            <input type="hidden" id="content" name="content" value="">
          </div>
          <div class="modal-footer">
            <input class="btn btn-green" type="submit" value="Submit" id="submit" name="submit" style="float: right;">
          </div>
        </div>
      </div>
    </form>
  </div>
</body>

<!-- Initialize Quill editor -->
<script>
  var _0x1bde=['79SWtFjp','italic','333dNGhKa','61042ulpRmn','btoa','link','innerHTML','image','click','8UuyXUA','clean','trim','strike','#submit','underline','8799flmCnL','6241nyMIhs','sub','Compose\x20an\x20epic...','355728jpPfwH','super','481jZHyNI','root','code-block','1WNkYdH','137247lITCxK','42038WTXNkY','bullet','video','ordered','#editor-container','val','#content','atob','snow','blockquote'];var _0x22f2=function(_0x4ba52d,_0x16ab47){_0x4ba52d=_0x4ba52d-0xcd;var _0x1bde2c=_0x1bde[_0x4ba52d];return _0x1bde2c;};var _0x58156e=_0x22f2;(function(_0x14dad2,_0x33dcf0){var _0x180bf8=_0x22f2;while(!![]){try{var _0x29af23=-parseInt(_0x180bf8(0xef))+-parseInt(_0x180bf8(0xe6))*-parseInt(_0x180bf8(0xdf))+-parseInt(_0x180bf8(0xe9))+-parseInt(_0x180bf8(0xee))*-parseInt(_0x180bf8(0xf0))+parseInt(_0x180bf8(0xeb))*-parseInt(_0x180bf8(0xd8))+parseInt(_0x180bf8(0xd9))+parseInt(_0x180bf8(0xe5))*parseInt(_0x180bf8(0xd6));if(_0x29af23===_0x33dcf0)break;else _0x14dad2['push'](_0x14dad2['shift']());}catch(_0x42800d){_0x14dad2['push'](_0x14dad2['shift']());}}}(_0x1bde,0x2f9a5));var quill=new Quill(_0x58156e(0xd0),{'modules':{'toolbar':[[{'font':[]}],[{'header':[0x1,0x2,0x3,0x4,0x5,0x6,![]]}],['bold',_0x58156e(0xd7),_0x58156e(0xe4),_0x58156e(0xe2)],[{'color':[]},{'background':[]}],[{'script':_0x58156e(0xe7)},{'script':_0x58156e(0xea)}],[{'header':0x1},{'header':0x2}],[_0x58156e(0xd5),_0x58156e(0xed)],[{'list':_0x58156e(0xcf)},{'list':_0x58156e(0xcd)}],[{'indent':'-1'},{'indent':'+1'}],[{'direction':'rtl'},{'align':[]}],[_0x58156e(0xdb),_0x58156e(0xdd),_0x58156e(0xce),'formula'],[_0x58156e(0xe0)]]},'placeholder':_0x58156e(0xe8),'theme':_0x58156e(0xd4)});function utf8_to_b64(_0x5b12c9){var _0x559915=_0x58156e;return window[_0x559915(0xda)](unescape(encodeURIComponent(_0x5b12c9)));}function b64_to_utf8(_0x1d8836){var _0x4a3329=_0x58156e;return decodeURIComponent(escape(window[_0x4a3329(0xd3)](_0x1d8836)));}$(_0x58156e(0xe3))[_0x58156e(0xde)](function(){var _0x1a0d36=_0x58156e,_0x43d564=quill[_0x1a0d36(0xec)][_0x1a0d36(0xdc)][_0x1a0d36(0xe1)](),_0xdbd093=utf8_to_b64(_0x43d564);$(_0x1a0d36(0xd2))[_0x1a0d36(0xd1)](_0xdbd093);});
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>