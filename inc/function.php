<?php

function u_signup(){
  include("inc/db.php");
  if(isset($_POST['u_signup'])){
    $u_name = $_POST['u_name'];
    $u_email = $_POST['u_email'];

    $u_img = $_FILES['u_img'] ['name'];
    $u_img_tmp = $_FILES['u_img'] ['tmp_name'];

    move_uploaded_file($u_img_tmp, "imgs/u_img/$u_img");

    $u_add = $_POST['u_add'];
    $u_country = $_POST['u_country'];
    $u_state = $_POST['u_state'];
    $u_pin = $_POST['u_pin'];
    $u_date = $_POST['u_date'];
    $u_phone = $_POST['u_phone'];

    $u_pass = mt_rand();

    $add_user = $con->prepare("insert into user(u_name,u_email,u_img,u_add,u_country,u_state,u_pin,u_dob,u_phone,u_pass,u_reg_date) values('$u_name','$u_email','$u_img','$u_add','$u_country','$u_state','$u_pin','$u_date','$u_phone','$u_pass',NOW())");
    if($add_user->execute()){
      echo "<script>alert('Congratulation Your Registration Was Successful, Check Your Email We Have Sent You Your Password!')</script>";
      echo "<script>window.open('index.php','_self');</script>";
    }
    else{
      echo "<script>alert('Registration Failed Try Again!')</script>";
    }


  }
}

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

function add_cart(){
  include("inc/db.php");
  if(isset($_POST['cart_btn'])){
    $pro_id = $_POST['pro_id'];
    $ip=getIp();

    $check_cart = $con->prepare("select * from cart where pro_id='$pro_id' AND ip_add='$ip'");
    $check_cart->execute();

    $row_check = $check_cart->rowCount();
    
    if($row_check==1){
      echo "<script>alert('This Product Is Already Added In Your Cart !!'); </script>";
    }else{
      $add_cart = $con->prepare("insert into cart(pro_id,qty,ip_add) values('$pro_id','1','$ip') ");
    if ($add_cart->execute()) {
      echo "<script>alert('Product Added In Your Cart !!'); </script>";
      echo "<script>window.open('index.php','_self');</script>";

    }else{
      echo "<script>alert(!Try again !!!);</script>";
       }
    }
    
  }
}

function cart_count(){
  include("inc/db.php");
   $ip=getip();
   $get_cart_item = $con->prepare("select * from cart where ip_add='$ip'");
   $get_cart_item->execute();

   $count_cart = $get_cart_item->rowCount();

   echo $count_cart;
}

function cart_display(){
  include("inc/db.php");
  $ip=getIp();
  $get_cart_item = $con->prepare("select * from cart where ip_add='$ip'");
  $get_cart_item->setFetchMode(PDO:: FETCH_ASSOC);
  $get_cart_item->execute();
   
   $cart_empty = $get_cart_item->rowCount();
   $net_total=0;
   if($cart_empty==0){
     echo "<center><h2>No Product Found In Your Cart <a href='index.php'>Continue Shopping</h2></center>";
   }else{ 
    if(isset($_POST['up_qty'])){
      $quantity = $_POST['qty'];

      foreach($quantity as $key=>$value){
        $update_qty = $con->prepare("update cart set qty='$value' where cat_id='$key'");
        if($update_qty->execute()){
          echo "<script>window.open('cart.php','_self');</script>";
        }

      }
    }
     echo "<table cellpadding='0' cellspacing='0'>
             <tr>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Remove</th>
                  <th>Sub Total</th>
             </tr>";

  while($row=$get_cart_item->fetch()):
    $pro_id = $row['pro_id'];

    $get_pro = $con->prepare("select * from pro_cat where pro_id='$pro_id'");
    $get_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $get_pro->execute();
    $row_pro = $get_pro->fetch();
    echo "<tr>
              <td><img src='imgs/product_img/".$row_pro['pro_img1']."' /></td>
              <td>".$row_pro['pro_name']."</td>
              <td><input type='text' name='qty[".$row['cat_id']."]' value='".$row['qty']."' /><input type='submit' name='up_qty' value='Save' /></td>
              <td>".$row_pro['pro_price']."</td>
              <td><a href='delete.php?delete_id=".$row_pro['pro_id']."'><i class='fa fa-trash'></i></a></td>
              <td>";
                $qty = $row['qty'];
                $pro_price = $row_pro['pro_price'];
                $sub_total = $pro_price*$qty;
                echo $sub_total;
                $net_total = $net_total+$sub_total;
              echo"</td>
          </tr>";
 endwhile;
         echo "<tr><td></td>
                   <td><button id='buy_now'><a href='index.php'>Continue Shopping</a></button></td> 
                   <td><button id='buy_now'>Check Out</button></td> 
                   <td></td><td><b>Net Total = &#8358;</b></td>
                   <td><b>$net_total</b></td>   
              </tr>";
            }
          }


function delete_cart_items(){
  include("inc/db.php");
  if(isset($_GET['delete_id'])){
    $pro_id = $_GET['delete_id'];

    $delete_pro = $con->prepare("delete from cart where pro_id='$pro_id'");

    if($delete_pro->execute()){
      echo "<script>alert('Product Deleted Successfully')</script>";
      echo "<script>window.open('cart.php', '_self');</script>";
    }
  }
}

  function electronics(){
  	include("inc/db.php");

  	$fetch_cat = $con->prepare("select * from main_cat"); 
  	$fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
  	$fetch_cat->execute();

  	while($row_cat = $fetch_cat->fetch()):
  	$cat_id = $row_cat['cat_id'];

  	echo "<h3>".$row_cat['cat_name']."</h3><ul>";

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
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_pro['pro_id']."'> <i class='fa fa-eye'></i> </a></button>
                         <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
                </form>
            </li>";
  endwhile;
  echo "<ul/><br clear='all' />";
endwhile;

  }

  

 function pro_details(){
   include("inc/db.php");

       if(isset($_GET['pro_id'])){
       $pro_id = $_GET['pro_id'];

      $pro_fetch = $con->prepare("select * from pro_cat where pro_id='$pro_id'");
      $pro_fetch->setFetchMode(PDO:: FETCH_ASSOC);
      $pro_fetch->execute();
     
      $row_pro = $pro_fetch->fetch();
      $cat_id=$row_pro['cat_id'];


      echo "<div id='pro_img'>
              <img src='imgs/product_img/".$row_pro['pro_img1']."' />
              <ul>
                 <li><img src='imgs/product_img/".$row_pro['pro_img1']."' /></li>
                 <li><img src='imgs/product_img/".$row_pro['pro_img2']."' /></li>
                 <li><img src='imgs/product_img/".$row_pro['pro_img3']."' /></li>
                 <li><img src='imgs/product_img/".$row_pro['pro_img4']."' /></li>
              </ul>
            </div>
            <div id='pro_features'>
              <h3>".$row_pro['pro_name']."</h3>
              <ul>
                  <li>".$row_pro['pro_feature1']."</li>
                  <li>".$row_pro['pro_feature2']."</li>
                  <li>".$row_pro['pro_feature3']."</li>
                  <li>".$row_pro['pro_feature4']."</li>
                  <li>".$row_pro['pro_feature5']."</li>
              </ul>
              <ul>
                  <li>Model No. : ".$row_pro['pro_model']."</li>
                  <li>Warranty :  ".$row_pro['pro_warranty']."</li>
                  <li>Discount :  ".$row_pro['pro_discount']."</li>
                  <li>Quantity :  ".$row_pro['pro_quantity']."</li>
              </ul><br clear='all' />
              <center>
              <h4>Selling Price :  ".$row_pro['pro_price']."</h4>
              <form method='post'>
                    <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
                    <button id='buy_now' name='buy_now'>Buy Now</button>
                    <button id='buy_now' name='cart_btn'>Add To Cart</button>
              </form>
              </center>
            </div><br clear='all' />
            <div id='sim_pro'>
               <h3>Related Product</h3>
               <ul>";
                   echo add_cart();
                   $sim_pro = $con->prepare("select * from pro_cat where pro_id!=$pro_id AND cat_id='$cat_id' LIMIT 0,5");
                   $sim_pro->setFetchMode(PDO:: FETCH_ASSOC);
                   $sim_pro->execute();
                   while($row=$sim_pro->fetch()):
                   echo"<li>
                            <a href='pro_details.php?pro_id=".$row['pro_id']."'>
                                <img src='imgs/product_img/".$row['pro_img1']."' />
                                <p>".$row['pro_name']."</p>
                                 <p>Price : ".$row['pro_price']."</p>
                            </a>
                        </li>";
                   endwhile;
               echo"</ul>
            </div>";

    }
  }

  function all_cat(){
    include("inc/db.php");
    $all_cat = $con->prepare("select * from main_cat");
    $all_cat->setFetchMode(PDO:: FETCH_ASSOC);
    $all_cat->execute();

    while($row=$all_cat->fetch()):
      echo"<li><a href='cat_details.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</li></a>";
    endwhile; 
  }

  function cat_detail(){
    include("inc/db.php");  
    if(isset($_GET['cat_id'])){
      $cat_id = $_GET['cat_id'];
      $cat_pro = $con->prepare("select * from pro_cat where cat_id='$cat_id' ");
      $cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
      $cat_pro->execute();

      $cat_name = $con->prepare("select * from main_cat where cat_id='$cat_id' ");
      $cat_name->setFetchMode(PDO:: FETCH_ASSOC);
      $cat_name->execute();

      $row = $cat_name->fetch();
      $row_main_cat = $row['cat_name'];
      echo"<h3>$row_main_cat</h3>";

        while($row_cat = $cat_pro->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_cat['pro_id']."'>
                  <h4>".$row_cat['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_cat['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_cat['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;


    }
  }

  function viewall_sub_cat(){
    include("inc/db.php");
    if(isset($_GET['cat_id'])){
      $cat_id = $_GET['cat_id'];
      $sub_cat = $con->prepare("select * from sub_cat where cat_id='$cat_id'");
      $sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
      $sub_cat->execute();
      echo "<h3>Sub Categories</h3>";
      while($row=$sub_cat->fetch()):
       echo" <li>
               <a href='cat_details.php?sub_cat_id=".$row['sub_cat_id']."'>".$row['sub_cat_name']."</a>
            </li>";
      endwhile; 

    }
  }

  function sub_cat_detail(){
    include("inc/db.php");  
    if(isset($_GET['sub_cat_id'])){
      $sub_cat_id = $_GET['sub_cat_id'];
      $sub_cat_pro = $con->prepare("select * from pro_cat where sub_cat_id='$sub_cat_id' ");
      $sub_cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
      $sub_cat_pro->execute();

      $sub_cat_name = $con->prepare("select * from sub_cat where sub_cat_id='$sub_cat_id' ");
      $sub_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
      $sub_cat_name->execute();

      $row = $sub_cat_name->fetch();
      $row_sub_cat = $row['sub_cat_name'];
      echo"<h3>$row_sub_cat</h3>";

        while($row_sub_cat = $sub_cat_pro->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_sub_cat['pro_id']."'>
                  <h4>".$row_sub_cat['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_sub_cat['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_sub_cat['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;


    }
  }

 function viewall_cat(){
    include("inc/db.php");
    if(isset($_GET['sub_cat_id'])){
      $main_cat = $con->prepare("select * from main_cat");
      $main_cat->setFetchMode(PDO:: FETCH_ASSOC);
      $main_cat->execute();
       echo "<h3>Categories</h3>";
      while($row=$main_cat->fetch()):
       echo" <li>
               <a href='cat_details.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a>
            </li>";
      endwhile; 

    }
  }

 function bd_men(){
  include("inc/db.php");
  if(isset($_GET['bd_men'])){
    $fetch_pro = $con->prepare("select * from pro_cat where for_whome='men'");
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();
    echo"<h3>Birthday Gifts For Men</h3>";

     while($row_men = $fetch_pro->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_men['pro_id']."'>
                  <h4>".$row_men['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_men['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_men['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;

   }
 } 

 function bd_women(){
  include("inc/db.php");
  if(isset($_GET['bd_women'])){
    $fetch_pro = $con->prepare("select * from pro_cat where for_whome='women'");
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();
    echo"<h3>Birthday Gifts For Women</h3>";

     while($row_men = $fetch_pro->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_men['pro_id']."'>
                  <h4>".$row_men['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_men['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_men['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;

   }
 }

 function bd_kids(){
  include("inc/db.php");
  if(isset($_GET['bd_kids'])){
    $fetch_pro = $con->prepare("select * from pro_cat where for_whome='kids'");
    $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    $fetch_pro->execute();
    echo"<h3>Birthday Gifts For Kids</h3>";

     while($row_men = $fetch_pro->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_men['pro_id']."'>
                  <h4>".$row_men['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_men['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_men['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;

   }
 }

 function all_about_men(){
  include("inc/db.php");
  if(isset($_GET['men_watch'])){
    $men_watch="watch";

    $watch = $con->prepare("select * from pro_cat where for_whome='men' and pro_name like '%$men_watch%'");
    $watch->setFetchMode(PDO:: FETCH_ASSOC);
    $watch->execute();

     echo"<h3>Watches For Men</h3>";

     while($row_watch = $watch->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_watch['pro_id']."'>
                  <h4>".$row_watch['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_watch['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_watch['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
   }

   if(isset($_GET['men_belt'])){
    $men_belt="belt";

    $belt = $con->prepare("select * from pro_cat where for_whome='men' and pro_name like '%$men_belt%'");
    $belt->setFetchMode(PDO:: FETCH_ASSOC);
    $belt->execute();

     echo"<h3>Belts For Men</h3>";

     while($row_belt = $belt->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_belt['pro_id']."'>
                  <h4>".$row_belt['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_belt['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_belt['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
   }

   if(isset($_GET['men_perfumes'])){
    $men_perfumes="perfumes";

    $perfumes = $con->prepare("select * from pro_cat where for_whome='men' and pro_name like '%$men_perfumes%'");
    $perfumes->setFetchMode(PDO:: FETCH_ASSOC);
    $perfumes->execute();

     echo"<h3>Perfumes For Men</h3>";

     while($row_perfumes = $perfumes->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_perfumes['pro_id']."'>
                  <h4>".$row_perfumes['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_perfumes['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_perfumes['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
   }
 }

 function all_about_women(){
  include("inc/db.php");
  if(isset($_GET['women_watch'])){
    $women_watch="watch";

    $watch = $con->prepare("select * from pro_cat where for_whome='women' and pro_name like '%$women_watch%'");
    $watch->setFetchMode(PDO:: FETCH_ASSOC);
    $watch->execute();

     echo"<h3>Watches For Women</h3>";

     while($row_watch = $watch->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_watch['pro_id']."'>
                  <h4>".$row_watch['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_watch['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_watch['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
   }

   if(isset($_GET['women_belt'])){
    $women_belt="belt";

    $belt = $con->prepare("select * from pro_cat where for_whome='women' and pro_name like '%$women_belt%'");
    $belt->setFetchMode(PDO:: FETCH_ASSOC);
    $belt->execute();

     echo"<h3>Belts For Women</h3>";

     while($row_belt = $belt->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_belt['pro_id']."'>
                  <h4>".$row_belt['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_belt['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_belt['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
   }

   if(isset($_GET['women_perfumes'])){
    $women_perfumes="perfumes";

    $perfumes = $con->prepare("select * from pro_cat where for_whome='women' and pro_name like '%$women_perfumes%'");
    $perfumes->setFetchMode(PDO:: FETCH_ASSOC);
    $perfumes->execute();

     echo"<h3>Perfumes For Women</h3>";

     while($row_perfumes = $perfumes->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_perfumes['pro_id']."'>
                  <h4>".$row_perfumes['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_perfumes['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_perfumes['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
   }
 }

 function all_about_kids(){
  include("inc/db.php");
  if(isset($_GET['kids_watch'])){
    $kids_watch="watch";

    $watch = $con->prepare("select * from pro_cat where for_whome='kids' and pro_name like '%$kids_watch%'");
    $watch->setFetchMode(PDO:: FETCH_ASSOC);
    $watch->execute();

     echo"<h3>Watches For Kids</h3>";

     while($row_watch = $watch->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_watch['pro_id']."'>
                  <h4>".$row_watch['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_watch['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_watch['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
   }

   if(isset($_GET['kids_belt'])){
    $kids_belt="belt";

    $belt = $con->prepare("select * from pro_cat where for_whome='kids' and pro_name like '%$kids_belt%'");
    $belt->setFetchMode(PDO:: FETCH_ASSOC);
    $belt->execute();

     echo"<h3>Belts For Kids</h3>";

     while($row_belt = $belt->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_belt['pro_id']."'>
                  <h4>".$row_belt['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_belt['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_belt['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
   }

   if(isset($_GET['kids_perfumes'])){
    $kids_perfumes="perfumes";

    $perfumes = $con->prepare("select * from pro_cat where for_whome='kids' and pro_name like '%$kids_perfumes%'");
    $perfumes->setFetchMode(PDO:: FETCH_ASSOC);
    $perfumes->execute();

     echo"<h3>Perfumes For Kids</h3>";

     while($row_perfumes = $perfumes->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row_perfumes['pro_id']."'>
                  <h4>".$row_perfumes['pro_name']."</h4>
                  <img src='imgs/product_img/".$row_perfumes['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row_perfumes['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
   }
 }

 function search(){
  include("inc/db.php");
  if(isset($_GET['search'])){

  $user_query = $_GET['user_query'];
  $search=$con->prepare("select * from pro_cat where pro_name like '%$user_query%' or pro_discount like '%$user_query%' or pro_price like '%$user_query%' or pro_keyword like '%$user_query%'");
  $search->setFetchMode(PDO:: FETCH_ASSOC);
  $search->execute();
  echo "<div id='left'><ul>";

  if($search->rowCount()==0){
    echo "<h2>Product Not Found</h2>";
  }
  else{
  while($row = $search->fetch()):
      echo "<li>
                <a href='pro_details.php?pro_id=".$row['pro_id']."' />
                  <h4>".$row['pro_name']."</h4>
                  <img src='imgs/product_img/".$row['pro_img1']."' />
                  <center>
                         <button id='pro_btn'><a href='pro_details.php?pro_id=".$row['pro_id']."'> <i class='fa fa-eye'></i>  </a></button>
                         <button id='pro_btn' name='cart_btn'> <i class='fa fa-cart-arrow-down'></i> </button>
                         <button id='pro_btn'><a href='#'> <i class='fa fa-heart'></i> </a></button>
                  </center>
                </a>
            </li>";
  endwhile;
    }
  echo "</div></ul>";
  }

 }

?>