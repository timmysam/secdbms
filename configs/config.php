<?php
  session_start();
  $con = mysqli_connect("localhost", "root", "", "ouiproject");
  if(mysqli_connect_errno()){
    echo "failed to connect".mysqli_connect_errno();
  }

?>