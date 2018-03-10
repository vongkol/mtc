<?php
$con = mysqli_connect("localhost", "hrangkor_jobuser", "Khmer@123", "hrangkor_jobdb");
$d = date('Y-m-d');
$sql = "update subscriptions set is_expired=1 where expired_date<CURDATE() and active=1";
mysqli_query($con, $sql);
mysqli_close($con);
?>