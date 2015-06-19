<?php
require_once 'lib/lib.alert.php';
if(isset($_SESSION['ERROR'])){
    echo error($_SESSION['ERROR']);
    echo "<script>setTimeout(function(){ $('.alert').remove(); },3000);</script>";
    unset($_SESSION['ERROR']);
}
if(isset($_SESSION['STATUS'])){
    echo success($_SESSION['STATUS']);
    echo "<script>setTimeout(function(){ $('.alert').remove(); },3000);</script>";
    unset($_SESSION['STATUS']);
}
?>
