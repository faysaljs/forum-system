<?php require "includes/header.php" ?>
<?php require "config/config.php" ?>

<?php 

if(isset($_POST["submit"])){

  $title = $_POST["title"];
  $post_author = $_POST["post_author"];
  $category = $_POST["category"];
  $body = $_POST["body"];

  if (empty($title) or empty($post_author) or empty($category) or empty($body)) {
    echo "<script> alert('one or more inputs are empty!') </script>";
  }else{
    $sql = "INSERT INTO posts (title , post_author, category, body) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    $stmt->execute([$title, $post_author, $category, $body]);

    header("location: index.php");
  }

}


// gettiing categories 

$sqlC  = "SELECT *  FROM categories ;";

  $stmtC = $conn->prepare($sqlC);

  $stmtC->execute();

  $all_categories = $stmtC->fetchAll(PDO::FETCH_ASSOC);

?>



          <!-- Main content -->
          <div style="margin-top: 57px;" class="col-lg-9 mb-3">
           
           

            <form action="create-post.php" method="POST">

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Title </label>
                  <input type="text" name="title" placeholder="write title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                <div class="form-group mb-3">
                      <label for="exampleFormControlTextarea1">Body</label>
                      <textarea name="body" placeholder="write body" class="form-control"  rows="3"></textarea>
                </div>

                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Post Author</label>
                  <input type="text" name="post_author" placeholder="write author name" class="form-control" id="exampleInputPassword1">
                </div>

                <select name="category" class="form-select mb-5 mt-5" aria-label="Default select example">
                    <label class="form-label">Choose Category</label>
                    <option selected>Choose Category</option>

                  <?php foreach($all_categories as $category){ ?>
                    <option value="<?php echo $category["name"]?>"><?php echo $category["name"]?></option>
                    
                  <?php } ?>
                </select>

                <button name="submit" type="submit" class="btn btn-primary w-100">Submit</button>

              </form>
          
       
          </div>

          <?php require "includes/footer.php" ?>
