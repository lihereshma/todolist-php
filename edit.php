<?php
  include_once "db.php";

  if(isset($_GET['edit_item'])) {
    $e_id = $_GET['edit_item'];
  }
  
  $sql = "SELECT * FROM items WHERE t_id = $e_id;";
  $edit_result = mysqli_query($connection, $sql);
  $data = mysqli_fetch_array($edit_result);

  // Update function
  if(isset($_POST['update'])) {
    $edit_item = $_POST['item'];
    if(empty($edit_item) || $edit_item == " ") {
      $error = "empty field not allowed";
    } else {
      $query = "UPDATE items SET t_name = '$edit_item' WHERE t_id = $e_id";
      $update_result = mysqli_query($connection, $query);

      if(!$update_result) {
        die("failed");
      } else {
        header ("location: index.php");
      }
    }
  }
?>

<!doctype html>

<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en"> 

<head>
  <meta charset="utf-8">
  <title>ToDo App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- Place favicon.ico in the root directory: mathiasbynens.be/notes/touch-icons -->
  <link rel="shortcut icon" href="favicon.ico" />
  <!--font-awesome link for icons-->
  <link rel="stylesheet" media="screen" href="assets/vendor/fontawesome-free-5.13.0-web/css/all.min.css">
  <!-- Default style-sheet is for 'media' type screen (color computer display).  -->
  <link rel="stylesheet" media="screen" href="assets/css/style.css">
  <link rel="stylesheet" media="screen" href="assets/css/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <div class="wrapper">
        <h1 class="text-center mt-3 mb-3">ToDo List</h1>
      </div>
    </header>
    <!--header section start-->
    <!--main section start-->
    <main>
      <div class="wrapper">
        <div class="todoForm p-3">
          <h3 class="text-success text-center">edit item</h3>
          <?php 
            if(isset($error)) {
              echo "<div class='alert alert-danger'>$error</div>";
            }
          ?>
          <form action="" method="POST">
            <div class="form-group col-lg-5">
              <input class="form-control" type="text" name="item" value="<?php echo $data['t_name']; ?>" maxlength="30" autocomplete=off>
            </div>
            <div class="form-group">
              <input class="btn btn-primary text-uppercase" type="submit" name="update" value="update">
            </div>          
          </form>
        </div>
      </div>
    </main>
    <!--main section end-->
  </div>
  <!--container end-->
</body>
</html>