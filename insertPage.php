<?php 
session_start();
require_once("LineLoginLib.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('LINE_LOGIN_CHANNEL_ID','1590308917');
define('LINE_LOGIN_CHANNEL_SECRET','d0599ef45a2bd074851f431df1c9565c');
define('LINE_LOGIN_CALLBACK_URL','https://emaeng-bot.herokuapp.com/login_uselib_callback.php');

$LineLogin = new LineLoginLib(
    LINE_LOGIN_CHANNEL_ID, LINE_LOGIN_CHANNEL_SECRET, LINE_LOGIN_CALLBACK_URL);

    if(!isset($_SESSION['ses_login_accToken_val'])){    
        $LineLogin->authorize(); 
        exit;
    }

    $accToken = $_SESSION['ses_login_accToken_val'];
    // Status Token Check
    if($LineLogin->verifyToken($accToken)){
        $accToken."<br><hr>";
        echo "Token Status OK <br>";  
    }
     
    $userInfo = $LineLogin->userProfile($accToken,true);
    if(!is_null($userInfo) && is_array($userInfo) && array_key_exists('userId',$userInfo)){
        $rs = $userInfo["userId"];
    }
    

session_destroy();
?>

<table id="round" align="center">
<tr>
<td colspan="2" align="center"><h2><font id="font">Add product</font></h2></td>
</tr>
	<form action="insertCom.php" method="post">
		<tr>
		<td id="font">Product code : </td>
		<td><input type="text" name="c_mail" style="width: 100%" onKeyUp="if(!(isNaN(this.value))) { alert('กรุณากรอกอักษร'); this.value="  ";}"/></td>
		</tr>
        <tr>
        <input type="hidden" name="$dataId" value="<?php echo $rs; ?>"/>
        </tr>
		<tr>
		<td colspan="2" align="center"><input id="font" type="submit" value="Insert" />
		<input id="font" type="reset" value="Cancel" /></td>
		</tr>
	</form>
     <!--<?php  echo $rs; ?>-->
</table>
<style>

#round {
    border-radius: 15px 50px;
    background: #e45d35;
    padding: 20px ;
    width:400px;
    height:150px;
}
#font {
    color : #45103c;
    font-size : 
}


</style>