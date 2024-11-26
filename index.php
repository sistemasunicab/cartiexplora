<?php
    include('./clases/ImageAttributeBuilder.php');
    include('./clases/ButtonStylesBannerBuilder.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $nivel = "raiz";
    include('components/headMain.php') 
?>
<body>
    <?php include('components/bannerCarrousel.php') ?>
    <?php include('components/academicOffer.php') ?>
    <!-- <?php //include('components/contentProof.php') ?> -->
    
    <?php
        $nivel = "raiz"; 
        include('components/bookstoresMain.php') 
    ?>
</body>
</html>