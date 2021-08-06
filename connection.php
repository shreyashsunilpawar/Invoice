<?php
$conn=mysqli_connect("localhost","root","","phpzag_demo");
if($conn==TRUE)
{?>
    <script>console.log("connection successs!");</script><?php
}
else
{
    ?>
    <script>console.log("connection Failed!");</script><?php
}
?>