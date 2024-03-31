<?php
//this is for database connection
require_once('database.php');


//this is for checking the user
function checkUser($data){
$db=$GLOBALS['db'];
$email_id=mysqli_real_escape_string($db,$data['email_id']);
$password=mysqli_real_escape_string($db,$data['password']);
$query="SELECT * FROM users WHERE email_id='$email_id' AND password='$password'";
$runQuery=mysqli_query($db,$query);
$user=mysqli_fetch_all($runQuery,MYSQLI_ASSOC);
if(count($user)>0)  {
    return $user;
}else{

    return false;
}
}


//this is for checking email
function checkEmail($data){
    $db=$GLOBALS['db'];
    $email_id=mysqli_real_escape_string($db,$data['email_id']);
    $query="SELECT * FROM users WHERE email_id='$email_id'";
    $runQuery=mysqli_query($db,$query);
    $user=mysqli_fetch_all($runQuery,MYSQLI_ASSOC);
    if(count($user)>0)  {
        return true;
    }else{
    
        return false;
    }
    }

//this is for checking the user
function checkRefCode($data){
    $db=$GLOBALS['db'];
    $ref_code=mysqli_real_escape_string($db,$data['ref_code']);

    $query="SELECT * FROM users WHERE user_code='$ref_code'";
    $runQuery=mysqli_query($db,$query);
    $user=mysqli_fetch_all($runQuery) ?? array();
    if(count($user)>0)  {
        return true;
    }else{
        return false;
    }
    }

//this id for generate user code
function genUserCode(){
$str="AB1CDE2FG3HI4JK5LM6NO7PQ8RS9TU0VQXYZ".time();
$str= str_split($str,1);
$l = count($str);
$user_code='';
for($i=0;$i<6;$i++){
$tn = rand(0,$l);
$user_code.=$str[$tn];
}

return $user_code;

}


    //this is for register a new user
function register($data){
    $db = $GLOBALS['db'];
    $user = [];
    $user['errors'] = [];

    // Escape user inputs
    $full_name = mysqli_real_escape_string($db, $data['full_name']);
    $email_id = mysqli_real_escape_string($db, $data['email_id']);
    $password = mysqli_real_escape_string($db, $data['password']);
    
    // If ref_code is not provided, generate a random one
    if(isset($data['ref_code'])){
        $ref_code = mysqli_real_escape_string($db, $data['ref_code']);
    } else {
        $ref_code = generateRandomRefCode();
    }

    // Check for empty fields
    if($full_name == '' || $email_id == '' || $password == ''){
        $user['errors'][] = "All fields are required!";
    }

    // Check if email already exists
    if(checkEmail($data)){
        $user['errors'][] = "User already exists";
    }

    // If there are no errors so far, proceed with user registration
    if(empty($user['errors'])){
        $user_code = genUserCode(); 
        $query = "INSERT INTO users(full_name,email_id,password,ref_code,user_code) ";
        $query .= "VALUES('$full_name','$email_id','$password','$ref_code','$user_code')";
        $runQuery = mysqli_query($db, $query);
        if($runQuery){
            $user['success'] = "User is created successfully!";
        } else {
            $user['errors'][] = "Something went wrong!";
        }
    }
    return $user;
}

function generateRandomRefCode(){
    // Generate a random alphanumeric string for ref_code
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $ref_code = '';
    for ($i = 0; $i < 8; $i++) {
        $ref_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $ref_code;
}

    

    function getRefList($data){
        $db=$GLOBALS['db'];
$ref_code=$data['ref_code'];
        $query="SELECT * FROM users WHERE ref_code='$ref_code'";
        $runQuery=mysqli_query($db,$query);
        $user = mysqli_fetch_all($runQuery,MYSQLI_ASSOC) ?? array();
        return $user;
        
    }