<?php

function adminLogin(){
    session_start();
    if (!isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true) {
       redirect('dashboard.php');
    }
    session_regenerate_id(true);
}

function redirect($url){
    echo"<script>
    window.location.href='$url';
    </script>";
}
function alert($type,$msg) {

    $bs_class = ($type == "Success") ? "alert - success": "alert-danger";


    echo <<<alert
    <div class="alert  $bs_class alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    alert;
}





?>