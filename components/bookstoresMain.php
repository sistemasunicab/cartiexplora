<?php
    if ($nivel == "raiz") {
        //<!-- BOOTSTRAP JS -->
        echo '<script src="assets/bookstores/bootstrap/js/bootstrap.bundle.js"></script>';
        //<!-- FONTAWESOME JS -->
        echo '<script src="assets/bookstores/fontawesome/js/all.js"></script>';
        //<!-- DATATABLE JS -->
        echo '<script src="assets/bookstores/datatable/datatables.js"></script>';
        //<!-- SELECT2 JS -->
        echo '<script src="assets/bookstores/select2/js/select2.js"></script>';
    }
    else if ($nivel == "uno") {
        //<!-- BOOTSTRAP JS -->
        echo '<script src="../assets/bookstores/bootstrap/js/bootstrap.bundle.js"></script>';
        //<!-- FONTAWESOME JS -->
        echo '<script src="../assets/bookstores/fontawesome/js/all.js"></script>';
        //<!-- DATATABLE JS -->
        echo '<script src="../assets/bookstores/datatable/datatables.js"></script>';
        //<!-- SELECT2 JS -->
        echo '<script src="../assets/bookstores/select2/js/select2.js"></script>';
    }        
    else if ($nivel == "dos") {
        //<!-- BOOTSTRAP JS -->
        echo '<script src="../../assets/bookstores/bootstrap/js/bootstrap.bundle.js"></script>';
        //<!-- FONTAWESOME JS -->
        echo '<script src="../../assets/bookstores/fontawesome/js/all.js"></script>';
        //<!-- DATATABLE JS -->
        echo '<script src="../../assets/bookstores/datatable/datatables.js"></script>';
        //<!-- SELECT2 JS -->
        echo '<script src="../../assets/bookstores/select2/js/select2.js"></script>';
    }        
    else if ($nivel == "tres") {
        //<!-- BOOTSTRAP JS -->
        echo '<script src="../../../assets/bookstores/bootstrap/js/bootstrap.bundle.js"></script>';
        //<!-- FONTAWESOME JS -->
        echo '<script src="../../../assets/bookstores/fontawesome/js/all.js"></script>';
        //<!-- DATATABLE JS -->
        echo '<script src="../../../assets/bookstores/datatable/datatables.js"></script>';
        //<!-- SELECT2 JS -->
        echo '<script src="../../../assets/bookstores/select2/js/select2.js"></script>';
    }        
?>