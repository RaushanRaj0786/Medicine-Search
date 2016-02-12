<?php session_start();

$requested_page = $_POST['page_num'];
$set_limit = (($requested_page - 1) * 12) . ",12";
$city = $_SESSION['search_city'];
$name = $_SESSION['search_name'];
 $temp = explode(" :: ", $name);
include('../conn.php');


//$result = mysqli_query($con,"select  * from images order by id asc limit $set_limit");
$q =  "select t2.* 
from (select id from medicine where name='$temp[0]' and brand='$temp[1]' and cost='$temp[2]') as t1,(select * from store where store.city='$city') as t2,availability 
where t1.id=availability.medicine_id and t2.id=availability.store_id order by average_rating desc limit $set_limit";
$result = mysqli_query($con,$q) or die(mysqli_error($con));



$html = '';

while ($row = mysqli_fetch_array($result)) {



    $html .= "<li><p>". $row['name']."</p>
            <h4>Address:</h4>
            <p>Shop Number :".  $row['shop_number']."</p>
            <p>".  $row['address_1']."</p>
            <p>".  $row['address_2']."</p>
            <p>".  $row['city']."</p>
            <p>Opneing Time:".  $row['opening_time']."</p>
            <p>Closing Time:".  $row['closing_time']."</p>
            <p>Off Day:".  $row['off_day']."</p>
            <p>Average Rating:".$row['average_rating']."</p>
            </li>";
}


echo $html;
exit;
?>

