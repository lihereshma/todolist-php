<?php
  include_once "db.php";

  if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM items WHERE t_name LIKE '%$search%';";
    $search_result = mysqli_query($connection, $query);
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
      <section>
        <div class="wrapper">
          <div class="todoForm p-3">
            <h3 class="text-success text-center">searched result</h3>
          </div>
        </div>
      </section>
      <section>
        <div class="wrapper">
          <div class="search p-0">
            <form action="search.php" method="POST">
              <div class="col-lg-4 m-auto">
                <input class="form-control" type="text" name="search" placeholder="Search Item" autocomplete=off>
              </div>
              <div class="mt-2">
                <?php 
                  if(empty($search) || $search == " ") {
                    echo "<div class='alert alert-danger'>empty field not allowed</div>";
                  } else if(mysqli_num_rows($search_result) === 0) {
                    echo "<div class='alert alert-warning'>no result found</div>";
                  } else {
                ?>
              </div>
            </form>
          </div>
          <div class="text-align-center">
            <table class="table table-hover table-bordered text-center">
              <thead class="font-weight-bold">
                <th>id</th>
                <th>item name</th>
                <th>date</th>
                <th>edit</th>
                <th>delete</th>
              </thead>
              <tbody>
                <?php
                  while($row = mysqli_fetch_assoc($search_result)) {
                    $t_id = $row['t_id'];
                    $t_name = $row['t_name'];
                    $t_date = $row['t_date'];
                  ?>
                  <tr>
                    <td><?php echo $t_id; ?></td>
                    <td><?php echo $t_name; ?></td>
                    <td><?php echo $t_date; ?></td>
                    <td>
                      <a href="edit.php?edit_item=<?php echo $t_id; ?>" class="eb text-success">edit</a>
                    </td>
                    <td>
                      <a href="index.php?delete_item=<?php echo $t_id; ?>" class="db text-danger">delete</a>
                    </td>
                  </tr>
                <?php }} ?>
              </tbody>
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