<!DOCTYPE html>  
<html>  
<head>  
    <title>Registration_Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <style>  
    body{
        background-image: url(cut.jpg);
        color:white;
        background-size: cover;
        font-size: large;
        text-align:center;
    }
    h1{
        text-align: center;
        margin-top: 0%;
    }
    input[type=text], input[type=password], textarea {  
        width: 40%;  
        padding: 15px;  
        margin: 5px 0 22px 0;  
        display: inline-block;  
        border: none;  
        background: #f1f1f1;  
        justify-self:center;
        text-align:center;
        border: 2px solid red;
        border-radius: 25px;
    }  
    input:hover,textarea:hover{
        background-color: rgba(197, 200, 200, 0.733);
    }
    input:focus, textarea:focus {  
        background-color: rgba(248, 212, 208, 0.87);  
        outline: none;  
    }  
    div {  
        padding: 10px 0;  
        }  
    hr {  
        border: 1px solid #f1f1f1;  
        margin-bottom: 25px;  
    }  
    .registerbtn {  
        color: white;
        background-color:#00bfff;   
        padding: 16px 20px;    
        border: none;  
        cursor: pointer;  
        width: 30%;  
        opacity: 0.7;  
        font-size: large;
        border: 2px solid #00bfff;
        border-radius: 12px;
    }  
    .registerbtn:hover {  
        opacity: 0.8;  
    }  
    </style>  
</head>  
<body>  




<?php  
// define variables to empty values  
$emailErr = $mobilenoErr = $PasswordErr ="";  
$name = $course =$mobileno= $gender = $mobileno=$address=$email = $password ="";  


//Input fields validation  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $first=$_POST["firstname"];
    if(isset($_POST['middle'])){
        $middle=$_POST["middle"];
        $middle=" ".$middle." ";
    }else{
        $middle=" ";
    }
    if(isset($_POST['last'])){
        $last=$_POST["last"];
    }else{
        $last="";
    }
    $name=$first.$middle.$last;
    $course=$_POST["Course"];
    $gender=$_POST["gender"];
    $address=$_POST["ca"];
      
    //Email Validation   
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    
    //Number Validation  
    $mobileno=$_POST["phone"];
    if (!is_numeric($mobileno) ) {  
        $mobilenoErr = "Only numeric value is allowed.";  
    }  
    //check mobile no length should not be less and greator than 10  
    if (strlen ($mobileno) != 10) {  
        $mobilenoErr = "Mobile no must contain 10 digits.";  
    }  

    //password Validation
    $password=$_POST["psw"];
    $password_repeat=$_POST["psw-repeat"];
    if($password!=$password_repeat){
        $PasswordErr="Passwords does not match.";
    }
}  
?>  
  

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
        <div class="container">  
            <h1> Student Registration Form</h1>  
            <hr>  
            <label> Firstname </label>  
            <br>
            <input type="text" name="firstname" placeholder= "Firstname" size="15" required />   
            <br>
            <label> Middlename: </label>
            <br>   
            <input type="text" name="middle" placeholder="Middlename" size="15" >   
            <br>
            <label> Lastname: </label>  
            <br>  
            <input type="text" name="last" placeholder="Lastname" size="15">   
            <br>
            <div>  
                <label>   
                Course :  
                </label>   
                <select name="Course" required>  
                    <option value="BCA">BCA</option>  
                    <option value="BBA">BBA</option>  
                    <option value="B.Tech">B.Tech</option>  
                    <option value="MBA">MBA</option>  
                    <option value="MCA">MCA</option>  
                    <option value="M.Tech">M.Tech</option>  
                </select>  
            </div>  
            <div>  
                <br>
                <label>   
                Gender :  
                </label>
                <input type="radio" value="Male" name="gender" checked > Male   
                <input type="radio" value="Female" name="gender"> Female   
                <input type="radio" value="Other" name="gender"> Other  
            </div>  
            <br>
            <label>   
            Phone :  
            </label>  
            <br>
            <input type="text" name="phone" placeholder="phone no." size="10" required>   
            <br><span class="error" style="color:yellow;">*<?php echo $mobilenoErr;?></span>
            <br>
            Current Address :  
            <br>
            <textarea cols="80" rows="5" placeholder="Current Address" value="address" name="ca" required>  
            </textarea>  
            <br>
            <label for="email"><b>Email</b></label>  
            <br>
            <input type="text" placeholder="Enter Email" name="email" required>  
            <br><span class="error" style="color:yellow;">* <?php echo $emailErr; ?> </span> 
            <br> 
            <label for="psw"><b>Password</b></label>  
            <br>
            <input type="password" placeholder="Enter Password" name="psw" required>  
            <br>
            <label for="psw-repeat"><b>Re-Enter Password</b></label>  
            <br>
            <input type="password" placeholder="ReEnter Password" name="psw-repeat" required>
            <br><span class="error" style="color:yellow;">*<?php echo $PasswordErr?></span>
            <br>  
            <button type="submit" class="registerbtn" name="submit">Register</button>    
    </form>
    <br><br>
    <h3>  
    <?php  
    if(isset($_POST['submit'])) {  
        if($emailErr == "" && $mobilenoErr == "" && $PasswordErr == "") {  
            echo "<h3 color = #FF0001> <b>You have sucessfully registered.</b> </h3>";    

            //sql connect
            $db_hostname="127.0.0.1";
            $db_username="root";
            $db_password="";
            $db_name="registration";
            $conn=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
            mysqli_query($conn,"INSERT INTO users VALUES ('$name','$course','$gender','$mobileno','$address','$email','$password')");
        }else {  
            echo "<h3> <b>You didn't filled up the form correctly.</b> </h3>";  
        }  
    }  
?> </h3>
  
</body>  
</html>  
