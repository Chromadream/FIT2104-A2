<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "index.html";
    header("location: login.php?Page=$page");
}
$MACRO = $_GET["page"];
switch ($MACRO) {
    case "singleprod":
        $PAGELIST = array("single_product.php", "ProductModify.php", "insert_it.php", "insert.php", "file_upload.php");
        $name = "Single Product";
        break;
    case "client":
        $PAGELIST = array("client.php", "clientModify.php", "email.php", "newClient_form.php", "newClient.php", "clientPDF.php", "createPDF.php");
        $name = "Client Page";
        break;
    case "project":
        $PAGELIST = array("project.php","projectModify.php","newProject_form.php","newProject.php");
        $name = "Project Page";
        break;
    case "category":
        $PAGELIST = array("category.php", "catModify.php", "newCat_form.php", "newCat.php");
        $name = "Category Page";
        break;
}
echo "Source code for $name";
foreach($PAGELIST as $page){
    echo "$page";
    show_source($page);
}
?>