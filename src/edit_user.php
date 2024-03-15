<?php
ob_start();
require("../conn/conn.php");

//get the userid passed from ajax
if(isset($_GET['userid'])) {
    $userid = mysqli_real_escape_string($conn,$_GET['userid']);
} else {
    $userid = NULL;
}

//check if form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userid'])) {
    $data = array();
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $fname = $_POST['user_fname'];
    $lname = $_POST['user_lname'];

    try {
        if(isset($_POST['new_pass']) && $_POST['new_pass'] != '') {
            $new_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
            $up_sql = "UPDATE users SET username = ?, user_fname = ?, user_lname = ?, userpass = ? WHERE userid = ?";
            $up_stmt = $conn->prepare($up_sql);
            $up_stmt->bind_param('ssssi',$username,$fname,$lname,$new_pass,$userid);
        } else {
            $up_sql = "UPDATE users SET username = ?, user_fname = ?, user_lname = ? WHERE userid = ?";
            $up_stmt = $conn->prepare($up_sql);
            $up_stmt->bind_param('sssi',$username,$fname,$lname,$userid);
        }
        $up_stmt->execute();
        $data['status'] = 'success';
        $data['msg'] = "user ID: $userid was edited";
    } catch(\mysqli_sql_exception $e) {
        $data['status'] = 'error';
        $data['msg'] = $e;
    }
    echo json_encode($data);
} else { //else if form is not submitted, show the edit user form
?>

<form name='edit_user' id='edit_user' action='' method='POST'>
    <?php
    //get user row from table
    $sql = "SELECT * FROM users WHERE userid = $userid";
    $stmt = $conn->query($sql);
    $row = $stmt->fetch_assoc();
    echo "<label for=userid>User ID:</label>
    <input type=number name=userid id=userid value=$row[userid] readonly><br>"; //userid is readonly, cannot be changed

    echo "<label for=userdate>User Created Date:</label>
    <input type=date name=userdate id=userdate value=$row[user_created_date] readonly><br>"; //date is readonly, cannot be changed

    echo "<label for=username>Username:</label>
    <input type=text name=username id=username value=$row[username] required><br>"; //username is required

    echo "<label for=user_fname>First Name:</label>
    <input type=text name=user_fname id=user_fname value=$row[user_fname] required><br>"; //first name is required

    echo "<label for=user_lname>Last Name:</label>
    <input type=text name=user_lname id=user_lname value=$row[user_lname] required><br>"; //last name is required

    echo "<label for=new_pass>Enter New Password: (leave blank if not changing password)</label>
    <input type=password name=new_pass id=new_pass><br>"; //new password is optional
    ?>
</form>

<script>
	$('#edit_user').submit(function(e) {
        e.preventDefault();
		$.ajax({
			url:'edit_user.php',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
            error: err => {
                console.log('edit error');
                let el = ("#datamodal");
                let m = bootstrap.Modal.getInstance(el);
                m.hide();
                create_alert('error','editing submission failure');
            },
			success:function(data) {
                console.log(data);
                data = $.parseJSON(data);

                if(data.status == 'success') {
                    let el = ("#datamodal");
                    let m = bootstrap.Modal.getInstance(el);
                    m.hide();
                    create_alert('success',data.msg);
                } else {
                    let el = ("#datamodal");
                    let m = bootstrap.Modal.getInstance(el);
                    m.hide();
                    create_alert('error',data.msg);
                }
			}
		});
	});
</script>

<?php }
?>

<?php ob_end_flush(); ?>