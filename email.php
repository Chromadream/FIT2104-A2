<?php
session_start();
if (!($_SESSION["access_status"] === "granted")) {
    $page = "email.php";
    header("location: login.php?Page=$page");
}
include("connection.php");
$CONNECTION=new mysqli($HOST,$USERNAME,$PASSWORD,$DATABASE);
$QUERY = "SELECT * FROM CLIENT where client_mailinglist = 'y' ORDER BY client_fname";
$RESULT = $CONNECTION->query($QUERY);

if(empty($_POST["check"])){ 
    ?>
    <html>
    <head>
        <title>Famox Mailing List Page</title>
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
    <a href="index.html" ><button>Return to Main Page</button></a><br/>
    <center>
    <h3>New Email</h3>
    <form method="post" action="email.php">
        <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
            <tr class="listheader">
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Email?</th>
            </tr>
            <?php
            while($row = $RESULT->fetch_assoc())
            {
                ?>
            <tr>
                <td><?php echo $row["client_fname"].' '.$row["client_lname"];?></td>
                <td><?php echo $row["client_email"];?></td>
                <td align="center"><input type="checkbox" name="check[]" value="<?php echo $row["client_email"];?>"></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <input type="text" name="subject" placeholder="Message subject" style="width: 500px;"><br />
        <input type="text" name="message" placeholder="Message body" style="width: 500px; height: 300px;"><br />
        <input type="submit" value="Send email">
    </form>
    </center>
    </body>
    </html>
<?php
}
else
{
    $FROM = "From: Harry Helper <harry.helper@monash.edu.au>";
    $message = $_POST["message"];
    $subject = $_POST["subject"];
    foreach($_POST["check"] as $dest)
    {
        if(!mail($dest,$subject,$message,$FROM))
        {
            echo "Email to ".$dest." is not sent";
        }
    }
    echo "Email sent.<br/><a href='email.php'><button>Send Another Email</button></a>";
}
?>