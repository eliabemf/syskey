<?php
    session_start();

    $dbcon = new mysqli("localhost","a_silva","Atila979818","a_silva");

    if($dbcon->connect_error) die ("Connection Error".$dbcon->connect_error);
    
    if(isset($_POST['username']))
    {
       $username = $dbcon->real_escape_string($_POST['username']);
       $pass = $dbcon->real_escape_string($_POST['psswd']);
       $sql = "SELECT * FROM Users WHERE u_username='$username' and u_passhash='$pass';";
       $result = $dbcon->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
       if($result->num_rows>0)
       {
           
           if($row['u_validate'] == 'ok')
           {
               $_SESSION["userid"] = $row['u_userid'];
               $_SESSION["username"] = $row['u_username'];
               $_SESSION["password"] = $row['u_passhash'];
               $_SESSION["email"] = $row['u_emailaddr'];
               header("Location: display.php");
           }
           else
           {
               echo "You need to validate your account. Check <b>".$row['u_emailaddr']."</b> to confirm.<BR>";
           }
       }
       else
       {
           echo  "You cannot login the page. Check your username/password";
       }
        
    }

?>

<HTML>
<BODY>
<script>
    function validate(form)
    {
        fail = validateUsername(form.username.value)
        fail += validatePassword(form.psswd.value)
        
        if(fail=="") return true
        else{ alert(fail); return false}
    }

    function validateUsername(field)
    {
        trim = field.replace(/\s+$/, '');
        trim2 = trim.replace(/  +/g, ' ');
        
        if(trim2=="") return "No username was entered/\n"
        else if(trim2.length < 5)
            return "Usernames must be at least 5 characters.\n"
        else if (/[^a-zA-Z0-9 ]/.test(field))
            return "Only a-z, A-Z, 0-9 and spaces allowed in Usernames.\n"
        return ""
    }

    function validatePassword(field)
    {
        if(field=="") return "No password was entered.\n"
        else if(field.length < 6)
            return "Passwords must be at least 6 characters.\n"
        return ""
    }
</script>
<form action="login.php" method="post" onsubmit="return validate(this)">
username: <input type="text" name="username"> <BR>
password: <input type="password" name="psswd"> <BR>
<BR>
<input type="submit" value="Log in"><BR>
<BR>
<input type=button onClick="location.href='index.html'" value='Home'>
</form>
</BODY>
</HTML>
