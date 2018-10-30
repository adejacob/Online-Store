function electronics(){
    include("inc/db.php");

    $fetch_cat = $con->prepare("select * from main_cat where cat_id='2'"); 
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat = $fetch_cat->fetch();
    $cat_id = $row_cat['cat_id'];

    echo "<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro = $con->prepare("select * from pro_cat where cat_id='$cat_id' LIMIT 0, 3 "); 
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro = $fetch_pro->fetch()):
      echo "<li>
               <form method='post' enctype='multipart/form-data'>
                <a href='pro_details.php?pro_id=".$row_pro['pro_id']."' />
                  <h4>".$row_pro['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_pro['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_pro['pro_id']."'>View </a></button>
                         <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
                         <button id='pro_btn' name='cart_btn'> Cart </button>
                         <button id='pro_btn'><a href='#'>Whishlist</a></button>
                  </center>
                </a>
                </form>
            </li>";
  endwhile;

  }

  function cerelack(){
    include("inc/db.php");

    $fetch_cat = $con->prepare("select * from main_cat where cat_id='1'"); 
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat = $fetch_cat->fetch();
    $cat_id = $row_cat['cat_id'];

    echo "<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro = $con->prepare("select * from pro_cat where cat_id='$cat_id' LIMIT 0, 3"); 
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro = $fetch_pro->fetch()):
      echo "<li>
               <form method='post' enctype='multipart/form-data'>
                <a href='pro_details.php?pro_id=".$row_pro['pro_id']."' />
                  <h4>".$row_pro['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_pro['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_pro['pro_id']."'>View </a></button>
                         <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
                         <button id='pro_btn' name='cart_btn'> Cart </button>
                         <button id='pro_btn'><a href='#'>Whishlist</a></button>
                  </center>
                </a>
                </form>
            </li>";
  endwhile;
  
  }

    function food(){
    include("inc/db.php");

    $fetch_cat = $con->prepare("select * from main_cat where cat_id='4'"); 
    $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_cat->execute();

    $row_cat = $fetch_cat->fetch();
    $cat_id = $row_cat['cat_id'];

    echo "<h3>".$row_cat['cat_name']."</h3>";

    $fetch_pro = $con->prepare("select * from pro_cat where cat_id='$cat_id'LIMIT 0,3"); 
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();

    while($row_pro = $fetch_pro->fetch()):
      echo "<li>
               <form method='post' enctype='multipart/form-data'>
                <a href='pro_details.php?pro_id=".$row_pro['pro_id']."' />
                  <h4>".$row_pro['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_pro['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_pro['pro_id']."'>View </a></button>
                         <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
                         <button id='pro_btn' name='cart_btn'> Cart </button>
                         <button id='pro_btn'><a href='#'>Whishlist</a></button>
                  </center>
                </a>
                </form>
            </li>";
  endwhile;

  }