 
<?php 

$sqlPs  = "SELECT * FROM posts ORDER BY created_at DESC;";

  $stmtPs = $conn->prepare($sqlPs);

  $stmtPs->execute();

  $all_posts = $stmtPs->fetchAll(PDO::FETCH_OBJ);


  // getting num of category 
  $sqlC  = "SELECT COUNT(*) AS num_categories FROM categories ;";

  $stmtC = $conn->prepare($sqlC);

  $stmtC->execute();

  $num_categories = $stmtC->fetch(PDO::FETCH_ASSOC);

   // getting num of posts 
   $sqlNP  = "SELECT COUNT(*) AS num_posts FROM posts ;";

   $stmtNP = $conn->prepare($sqlNP);
 
   $stmtNP->execute();
 
   $num_posts = $stmtNP->fetch(PDO::FETCH_ASSOC);


      // getting num of replies 
      $sqlNR  = "SELECT COUNT(*) AS num_replies FROM replies ;";

      $stmtNR = $conn->prepare($sqlNR);
    
      $stmtNR->execute();
    
      $num_replies = $stmtNR->fetch(PDO::FETCH_ASSOC);
?> 

 
 
 
 <!-- Sidebar content -->
 <div class="col-lg-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
            <div style="visibility: hidden; display: none; width: 285px; height: 801px; margin: 0px; float: none; position: static; inset: 85px auto auto;"></div><div data-settings="{&quot;parent&quot;:&quot;#content&quot;,&quot;mind&quot;:&quot;#header&quot;,&quot;top&quot;:10,&quot;breakpoint&quot;:992}" data-toggle="sticky" class="sticky" style="top: 85px;"><div class="sticky-inner">
              <a class="btn btn-lg btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold" href="create-post.php">Ask Question</a>
              <div class="bg-white mb-3">
                <h4 class="px-3 py-4 op-5 m-0">
                  Latest Posts
                </h4>
                <?php foreach($all_posts as $post){ ?>
                <hr class="m-0">
                <div class="pos-relative px-3 py-3">
                  <h6 class="text-primary text-sm">
                    <a href="single.php?id=<?php echo $post->id ?>" class="text-primary"> <?php echo $post->title ?></a>
                  </h6>
                  <p class="mb-0 text-sm"><span class="op-6">Posted at</span> <a class="text-black" href="#"><?php echo $post->created_at ?></a> <span class="op-6"> by</span> <a class="text-black" href="#"><?php echo $post->post_author ?></a></p>
                </div>
                <hr class="m-0">

                <?php } ?>
      
              </div>
              <div class="bg-white text-sm">
                <h4 class="px-3 py-4 op-5 m-0 roboto-bold">
                  Stats
                </h4>
                <hr class="my-0">
                <div class="row text-center d-flex flex-row op-7 mx-0">
                  <div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right"> <a class="d-block lead font-weight-bold" href="#"><?php echo $num_categories["num_categories"] ?></a> Categories </div>
                  <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $num_posts["num_posts"] ?></a> Posts </div>
                </div>
                <div class="row d-flex flex-row op-7">
                  <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0"> <a class="d-block lead font-weight-bold" href="#"><?php echo $num_replies["num_replies"]?></a> Replies </div>
                </div>
              </div>
            </div></div>
          </div>
        </div>
      </div>
  </body>
</html>