<?php
  include_once "db.php";

  $query ="SELECT * FROM items ORDER BY t_id DESC";
  $select_result = mysqli_query($connection, $query);

  // Add function
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $todo = $_POST['item'];
    $date = date('l dS F\, Y');
    
    if(empty($todo) || $todo == " ") {
      $error = "empty field not allowed";
    } else {
      $sql = "INSERT INTO items(t_name, t_date) values ('$todo', '$date') ORDER BY t_id DESC;";
      $add_result = mysqli_query($connection, $sql);

      if(!$add_result) {
        die("Failed");
      } else {
        header ("location: index.php");
      }
    }    
  }
  
  // Delete function
  if(isset($_GET['delete_item'])) {
    $delete = $_GET['delete_item'];
    $sqli = "DELETE FROM items WHERE t_id = $delete";
    $delete_result = mysqli_query($connection, $sqli);

    if(!$delete_result) {
      die("failed");
    } else {
      header ("location: index.php");
    }
  }
?>

<!doctype html>

<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en"> 

<head>
  <meta charset="utf-8">
  <title>ToDo App | Home</title>
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
        <h1 class="text-center pt-3 pb-3">ToDo List</h1>
      </div>
    </header>
    <!--header section end-->
    <!--main section start-->
    <main>
      <section>
        <div class="wrapper">
          <div class="todoForm p-3">
            <h3 class="text-success text-center">add new item</h3>
            <?php 
              if(isset($error)) {
                echo "<div class='alert alert-danger'>$error</div>";
              }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
              <div class="form-group col-lg-5">
                <input class="form-control" type="text" name="item" placeholder="Add Item" maxlength="30" autocomplete=off>
              </div>
              <div class="form-group">
                <input class="btn btn-primary text-uppercase" type="submit" name="add" value="add">
              </div>          
            </form>
          </div>
        </div>
      </section>
      <section>
        <div class="wrapper">
          <div class="col-lg-4 search p-0">
            <form action="search.php" method="POST">
              <div>
                <input class="form-control" type="text" name="search" placeholder="Search Item" autocomplete=off>
              </div>
             </form>
          </div>
          <div class="table-responsive">
            <table class="m-auto table col-lg-10 table-hover text-center">
              <thead class="font-weight-bold">
                <tr>
                  <th class="col-lg-1">item name</th>
                  <th>edit</th>
                  <th>delete</th>
                </tr>                
              </thead>
              <tbody>
                <?php
                  while($row = mysqli_fetch_assoc($select_result)) {
                    $t_id = $row['t_id'];
                    $t_name = $row['t_name'];
                    $t_date = $row['t_date'];
                  ?>
                  <tr>
                    <td><?php echo $t_name; ?></td>
                    <td>
                      <a href="edit.php?edit_item=<?php echo $t_id; ?>" class="eb text-success">edit</a>
                    </td>
                    <td>
                      <a href="index.php?delete_item=<?php echo $t_id; ?>" class="db text-danger">delete</a>
                    </td>
                  </tr>
                <?php } ?>
            </table>
          </div>
        </div>
      </section>      
    </main>
    <!--main section end-->
  </div>
  <!--container end-->
</body>
</html>