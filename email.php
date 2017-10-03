<?php
include("connection.php");
$CONNECTION=new mysqli($HOST,$USERNAME,$PASSWORD,$DATABASE);
$QUERY = "SELECT * FROM CLIENT where client_mailinglist == 'Y' ORDER BY client_lname";
$RESULT = $CONNECTION->query($QUERY);

if(empty($_POST["check"])
{ ?>
    <html>
    <head>
        <title>Famox Mailing List Page</title>
    </head>
    <body>
    <h1>Mailing List</h1>
    <form method="post" action="email.php">
        <table border="1" cellpadding="5">
            <tr>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Email?</th>
            </tr>
            <?php
            while($row = $RESULT->fetch_assoc())
            {
                ?>
            <tr>
                <td><?php echo $row["client_lname"].' '.$row["client_fname"];?></td>
                <td><?php echo $row["client_email"];?></td>
                <td align="center"><input type="checkbox" name="check[]" value="<?php echo $row["client_email"];?>"></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <input type="text" name="subject" placeholder="Message subject"><br />
        <input type="text" name="message" placeholder="Message body"><br />
        <input type="submit" value="Send email">
    </form>
    </body>
    </html>
<?php
}
else
{
    $FROM = "From: Harry Helper <harry.helper@famox.com.au>";
    $message = $_POST["message"];
    $subject = $_POST["subject"];
    foreach($_POST["check"] as $dest)
    {
        if(!mail($dest,$subject,$message,$FROM))
        {
            echo "Email to".$dest." is not sent";
        }
    }
    echo "Email sent.";
}
?>