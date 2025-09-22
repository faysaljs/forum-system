<?php require "includes/header.php" ?>
<?php require "config/config.php" ?>


<?php

$sqlP = "SELECT p.id as id, p.title as title, p.post_author as post_author , p.created_at as created_at, p.category as category , COUNT(r.post_id) AS num_replies FROM posts p LEFT JOIN replies r ON r.post_id = p.id GROUP BY r.post_id;";
$stmtP = $conn->prepare($sqlP);
$stmtP->execute();

$posts = $stmtP->fetchAll(PDO::FETCH_OBJ);







?>




          <!-- Main content -->
          <div style="margin-top: 43px;" class="col-lg-9 mb-3">
              <?php foreach($posts as $post){  ?>
              <div  class="mt-5 card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0">
                <div class="row align-items-center">
                  <div class="col-md-8 mb-3 mb-sm-0">
                    <h5>
                      <a href="single.php?id=<?php echo $post->id ?>" class="text-primary"><?php echo $post->title ?></a>
                    </h5>
                    <p class="text-sm"><span class="op-6">Posted</span> <a class="text-black" href="#"><?php echo $post->created_at ?></a> by <a class="text-black" href="#"><?php echo $post->post_author ?></a></p>
                    <div class="text-sm op-5"> <a class="text-black mr-2" href="#"><?php echo $post->category ?></a></div>
                  </div>
                  <div class="col-md-4 op-7">
                    <div class="row text-center op-7">
                      <div class="col px-1"> <i class="ion-ios-chatboxes-outline icon-1x"></i> <span class="d-block text-sm"><?php echo $post->num_replies ?> Replys</span> </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php } ?>
            
            
       
          </div>
         <?php require "includes/footer.php" ?>