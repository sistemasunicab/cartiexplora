<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $nivel = "raiz";
    include('components/headMain.php'); 
?>
<body>
    <?php 
        $nivel = "raiz";
        //include('components/navbar.php');
        include('components/navbar_ghf.php');
    ?>
    <?php include('components/contentProof.php'); ?>
    
    <?php
        $nivel = "raiz"; 
        include('components/bookstoresMain.php');
    ?>
</body>
</html>