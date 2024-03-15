<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php
require("../conn/conn.php");
$browser_title = 'PHP Moadl Demo - AlmostHDcode';
require("../page-assets/page_start.php");
?>

<table class="table table-hover">
    <tr>
        <th></th>
        <th>User ID</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>User Password</th>
        <th>User Created Date</th>
    </tr>
    <?php
    $sql = 'SELECT * FROM users';
    $stmt = $conn->query($sql);
    while($row = $stmt->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a class=edit_user href='javascript:void(0)' data-id=$row[userid]>EDIT</a></td>";
        echo "<td>$row[userid]</td>";
        echo "<td>$row[username]</td>";
        echo "<td>$row[user_fname]</td>";
        echo "<td>$row[user_lname]</td>";
        echo "<td>$row[userpass]</td>";
        echo "<td>$row[user_created_date]</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
echo "<br>";
$file = "test-pdf.pdf";
$b64 = base64_encode(file_get_contents($file));
$src = 'data:application/pdf;base64,' . $b64;
echo "<a id=show_pdf href='javascript:void(0)' data-src='$src'><button>View PDF</button></a>";
echo "<br><br>";
?>

<?php require("../page-assets/page_end.php"); ?>
<script>
$(document).ready(function() {
    $(".edit_user").on('click', function() {
        show_datamodal('Edit User','/edit_user.php?userid=' + $(this).attr('data-id'));
    });
    $("#show_pdf").on('click', function() {
        show_pdf_modal($(this).attr('data-src'));
    });
});
</script>
<?php ob_end_flush(); ?>
