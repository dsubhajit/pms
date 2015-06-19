<?php
    function error($error_text) {
        return '<div class="alert alert-danger" style="margin-bottom:0px;" >'.$error_text.'</div>';
    }
    function info($text) {
        return '<div class="alert alert-info" style="margin-bottom:0px;" >'.$text.'</div>';
    }
    function warn($text) {
        return '<div class="alert alert-warning" style="margin-bottom:0px;" >'.$text.'</div>';
    }
    function success($text) {
        return '<div class="alert alert-success" style="margin-bottom:0px;" ><span class="glyphicon glyphicon-ok" ></span> '.$text.'</div>';
    }
?>
