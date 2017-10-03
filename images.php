<?php
    include("connection.php");
    $CONNECTION=new mysqli($HOST,$USERNAME,$PASSWORD,$DATABASE);
    $QUERY = "SELECT * FROM PRODUCT";
    $RESULT = mysqli_query($CONNECTION,$QUERY);