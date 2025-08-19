<?php
$otp=rand(000000,999999);
?>
<form action="api/otp.php" method="post">
<input  type="email" name="email" placeholder="email" required><br><br>
      <input type="hidden" name="otp" id="" value="<?php echo $otp?>">
      <button type="submit">signup</button>
      <input type="submit" name="singup" value="singup">

</form>