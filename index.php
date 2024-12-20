<?php
    include('./clases/ImageAttributeBuilder.php');
    include('./clases/ButtonStylesBannerBuilder.php');
    include('./clases/FlexTitleLoader.php');
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
        include('components/navBar.php');
        include('components/bannerCarrousel.php');
        //include('components/contentProof.php');
        include('components/academicOffer.php');
        include('components/indicators.php');
        include('components/meetcampus.php');
        include('components/footer.php');
        include('components/bookstoresMain.php');
    ?>  
<body>
    
</html>