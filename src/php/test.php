<?php
    session_start();
    $arrayObject = [12222,2222212];
    $_SESSION['abcd']=$arrayObject;
?>
<!DOCTYPE html>   
<?php
    echo "abcd : ",$_SESSION['abcd'][0];
    echo "SID : ",defined('SID');
?>   
</html>

