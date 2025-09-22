<?php require "includes/header.php" ?>

<?php require "config/config.php" ?>

<?php

if (isset($_POST["submit"])) {

  $author_name = $_POST["author_name"];
  $replay = $_POST["replay"];
  $post_id = $_POST["post_id"];

  if (empty($author_name) or empty($replay) or empty($post_id)) {
    echo "<script> alert('one or more inputs are empty!') </script>";
  } else {

    $sql = "INSERT INTO replies (author_name , replay, post_id) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([$author_name, $replay, $post_id]);

    header("location: index.php");
  }
}



// getting replies 

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sqlR  = "SELECT * FROM replies where post_id='$id';";

  $stmtR = $conn->prepare($sqlR);

  $stmtR->execute();

  $replies = $stmtR->fetchAll(PDO::FETCH_OBJ);

  // gettin data for each post 

  $sqlP  = "SELECT * FROM posts where id='$id';";

  $stmtP = $conn->prepare($sqlP);

  $stmtP->execute();

  $singleP = $stmtP->fetch(PDO::FETCH_OBJ);

}



?>




<!-- Main content -->
<div style="margin-top: 43px;" class="col-lg-9 mb-3">

  <!-- End of post 1 -->
  <div class="mt-5 card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
    <div class="row align-items-center">
      <div class="col-md-12 mb-3 mb-sm-0">
        <h5>
          <a href="#" class="text-primary"><?php echo $singleP->title ?></a>
        </h5>
        <p>
        <?php echo $singleP->body ?>  
      </p>
        <p class="text-sm"><span class="op-6">Posted at</span> <a class="text-black" href="#"><?php echo $singleP->created_at ?></a> <span class="op-6"> by</span> <a class="text-black" href="#"><?php echo $singleP->post_author ?></a></p>
        <div class="text-sm op-5"> <a class="text-black mr-2" href="#"><?php echo $singleP->category ?></a></div>
      </div>

    </div>
  </div>

  <div style="margin-left: 40px;" class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
    <div class="row align-items-center">
      <div class="col-md-12 mb-3 mb-sm-0">
        <h5>
          <a href="#" class="text-primary">Write Replay</a>
        </h5>
        <form action="single.php" method="POST">
          <div class="form-group">
            <label for="exampleFormControlInput1">Author Name</label>
            <input type="text" name="author_name" class="form-control" id="exampleFormControlInput1" placeholder="author name">
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Replay</label>
            <textarea class="form-control" name="replay" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="form-group">
            <input type="hidden" name="post_id" value="<?php echo $id ?>" class="form-control" id="exampleFormControlInput1">
          </div>

          <button name="submit" type="submit" class="mt-4 btn btn-primary w-100">Add Replay</button>

        </form>
      </div>

    </div>
  </div>

  <!-- Replies -->

  <?php foreach ($replies as  $replay) {

  ?>

    <div style="margin-left: 40px;" class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
      <div class="row align-items-center">
        <div class="col-md-12 mb-3 mb-sm-0">
          <h5>
            <a href="#" class="text-primary"><?php echo $replay->author_name ?></a>
          </h5>
          <p>
            <?php echo $replay->replay ?>
          </p>
          <p class="text-sm"><span class="op-6">Commented at</span> <a class="text-black" href="#"><?php echo $replay->create_at ?></a> </p>
        </div>

      </div>
    </div>

  <?php } ?>



</div>
<?php require "includes/footer.php" ?>