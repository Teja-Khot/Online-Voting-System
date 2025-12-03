<?php 
    require_once("inc/header.php");
    require_once("inc/navigation.php");


if(isset($_GET['home']))
    {
        require_once("inc/home.php");
    }else if(isset($_GET['votepanel']))
    {
        require_once("inc/votepanel.php");
    }
?>


<?php
    require_once("inc/footer.php");
?>
