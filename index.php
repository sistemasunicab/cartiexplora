<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $nivel = "raiz";
    include('components/headMain.php') 
?>
<body>
    <?php 
        $nivel = "raiz";
        include('components/navBar.php') 
    ?>
    <?php include('components/contentProof.php') ?>
    
    <?php
        $nivel = "raiz"; 
        include('components/bookstoresMain.php') 
    ?>
</body>
</html>