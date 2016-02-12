<?php session_start(); ?>
<?php

if(isset($_POST['search'])){

  $city = $_POST['city'];
  $mediname = $_POST['medi_name'];
  $_SESSION['search_name'] = $mediname;
  $_SESSION['search_city'] = $city;
  $pos = strpos($mediname, "::");

  if ($pos !== false) {
     
} else {
     echo '<h3 style="text-align:center; top:300px;">Medicine no found in our database...</h3>';
     echo '<h3 style="text-align:center; top:300px;"><a href="index.php">Get Back</a></h3>';
     exit;
}
  $temp = explode(" :: ", $mediname);




include('conn.php');
mysqli_query($con,"update medicine set num_views = num_views+1 where name='$temp[0]' and brand='$temp[1]' and cost='$temp[2]'") OR die(mysqli_error($con));

  $query = "select t2.* 
from (select id from medicine where name='$temp[0]' and brand='$temp[1]' and cost='$temp[2]') as t1,(select * from store where store.city='$city') as t2,availability 
where t1.id=availability.medicine_id and t2.id=availability.store_id";
$re1 = mysqli_query($con,$query) or die(mysqli_error($con));
$actual_row_count = mysqli_num_rows($re1);
if($actual_row_count ==0){
  echo '<h3 style="text-align:center; top:300px;">Currently no store is having this medicine..</h3>';
     echo '<h3 style="text-align:center; top:300px;"><a href="index.php">Get Back</a></h3>';
     exit;
}
 include('top_header.php');


$q =  "select t2.* 
from (select id from medicine where name='$temp[0]' and brand='$temp[1]' and cost='$temp[2]') as t1,(select * from store where store.city='$city') as t2,availability 
where t1.id=availability.medicine_id and t2.id=availability.store_id order by average_rating desc limit 12";
$result = mysqli_query($con,$q) or die(mysqli_error($con));







?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- CSS Reset -->
  <link rel="stylesheet" href="cs/reset.css">

  <!-- Global CSS for the page and tiles -->
  <link rel="stylesheet" href="cs/main.css">
 

<title>Search Result</title>




</head>

<body>

<div class="bodysub">
 

  
      <ul id="tiles">
      
       <?php
            while ($row = mysqli_fetch_array($result)) {
    ?>
            <li><a href="store.php?store_id=<?php echo $row['id']?>" ><h4><?php echo $row['name'];?></h4>
            <p id="addtit"><b><i>Address:</i></b></p>
            <p id="shopno"><b><i>Shop Number :</i></b><?php echo $row['shop_number'];?></p>
            <p id="add1"><?php echo $row['address_1']?></p>
            <p id="add2"><?php echo $row['address_2']?></p>
            <p id="otime"><b><i>Opening Time:</i></b><?php echo $row['opening_time']?></p>
            <p id="ctime"><b><i>Closing Time:</i></b><?php echo $row['closing_time']?></p>
            <p id="offday"><b><i>Off Day:</i></b><?php echo $row['off_day']?></p>
            <p id="avgrat"><b><i>Average Rating:</i></b><?php echo $row['average_rating']?></p></a>
            </li>
                <?php
      }
      ?>
        <!-- These are our grid blocks -->
        
      </ul>

    </div>

  </div>

  <!-- include jQuery -->
  <script src="jquery/jquery.min.js"></script>

  <!-- Include the imagesLoaded plug-in -->
  <script src="jquery/jquery.imagesloaded.js"></script>

  <!-- Include the plug-in -->
  <script src="jquery/jquery.wookmark.min.js"></script>

  <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
  $(document).ready(function() {
        var slider = $('#slider').leanSlider({
            directionNav: '#slider-direction-nav',
            controlNav: '#slider-control-nav'
        });
    });
  
  
  
  
  
    (function ($){
    var page = 1;
      var $tiles = $('#tiles'),
          $handler = $('li', $tiles),
          $main = $('#main'),
          $window = $(window),
          $document = $(document),
          options = {
            autoResize: true, // This will auto-update the layout when the browser window is resized.
            container: $main, // Optional, used for some extra CSS styling
            offset: 20, // Optional, the distance between grid items
            itemWidth: 210 // Optional, the width of a grid item
          };

      /**
       * Reinitializes the wookmark handler after all images have loaded
       */
      function applyLayout() {
        $tiles.imagesLoaded(function() {
          // Destroy the old handler
          if ($handler.wookmarkInstance) {
            $handler.wookmarkInstance.clear();
          }

          // Create a new layout handler.
          $handler = $('li', $tiles);
          $handler.wookmark(options);
        });
      }

      /**
       * When scrolled all the way to the bottom, add more tiles
       */
      function onScroll() {
        // Check if we're within 100 pixels of the bottom edge of the broser window.
        var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
            closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

        if ((closeToBottom) ) {
       page++;

                    var data = {
                        page_num: page
                    };

                    var actual_count = "<?php echo $actual_row_count; ?>";
          if((page-1)* 12 > actual_count){
                        $('#no-more').css("top","400");
                        $('#no-more').show();
                    }else{
                        $.ajax({
                            type: "POST",
                            url: "imp_files/data.php",
                            data:data,
                            success: function(res) {
                                $("#tiles").append(res);
                                console.log(res);
                            }
                        });
                    }
          // Get the first then items from the grid, clone them, and add them to the bottom of the grid
        

          applyLayout();
        }
      };

      // Call the layout function for the first time
      applyLayout();

      // Capture scroll event.
      $window.bind('scroll.wookmark', onScroll);
    })(jQuery);
  </script>
</div>
</body>
</html>
<?php
}
?>
