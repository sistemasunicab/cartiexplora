<?php
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/ButtonStylesBannerBuilder.php');
    include('../../../clases/FlexTitleLoader.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $nivel = "tres";
    $page_title = "Blog UNICAB";
    include('../../../components/headMain.php');
?>
<body>
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
        
        include("../components/blogPostComponent.php");
        
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>  
<body>
    
</html>