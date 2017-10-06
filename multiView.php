<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "multiView.php";
    header("location: login.php?Page=$page");
}
$MACRO = $_GET["page"];
switch ($MACRO) {
    case "singleprod":
        $PAGELIST = array("single_product.php", "ProductModify.php", "insert_it.php", "insert.php", "file_upload.php");
        break;
    case "client":
        $PAGELIST = array("client.php", "clientModify.php", "email.php", "newClient_form.php", "newClient.php", "clientPDF.php", "createPDF.php");
        break;
    case "category":
        $PAGELIST = array("category.php", "catModify.php", "newCat_form.php", "newCat.php");
        break;
}
foreach($PAGELIST as $page){
    show_source($page);
}
?>