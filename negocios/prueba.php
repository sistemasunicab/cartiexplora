<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="../assets/librerias/bootstrap/css/bootstrap.css">
    <!-- FONTAWESOME CSS -->
    <link rel="stylesheet" href="../assets/librerias/fontawesome/css/all.css">
    <!-- DATATABLE CSS -->
    <link rel="stylesheet" href="../assets/librerias/datatable/datatables.css">
    <!-- SELECT2 CSS -->
    <link rel="stylesheet" href="../assets/librerias/select2/css/select2.css">

    <!-- Jquery JS  -->
    <script src="../assets/librerias/jquery-3.7.1.min.js"></script>
</head>
<body>
    <h1>Bienvenido</h1>
    <div class="container">
        <div class="row">
            <div class="col-3"><i class="fa-solid fa-spinner fa-spin-pulse"></i> col3</div>
            <div class="col-3"><span style="color: Tomato;"><i class="fa-solid fa-user"></i></span> col3</div>
            <div class="col-3"><i class="fa-solid fa-user fa-xs fa-fade"></i> col3</div>
            <div class="col-3"><i class="fa-solid fa-user fa-3x"></i> col3</div>
        </div>
        <div class="row">
            <div class="col-3"><i class="fa-solid fa-user fa-rotate-90"></i> col3</div>
            <div class="col-3"><span style="color: Tomato;"><i class="fa-solid fa-user fa-flip-vertical"></i></span> col3</div>
            <div class="col-3"><i class="fa-solid fa-user fa-sm fa-beat"></i> col3</div>
            <div class="col-3"><i class="fa-solid fa-user fa-3x fa-rotate-by" style="--fa-rotate-angle: 80deg;"></i> col3</div>
        </div>
        <div class="row">
            <div class="col-3"><input type="text" class="form-control" name="txt1" id="txt1" value="123"></div>
            <div class="col-3">
                <select name="sel1" id="sel1" class="form-control select2">
                    <option value="Colombia">Colombia</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Perú">Perú</option>
                    <option value="Brasil">Brasil</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Chile">Chile</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Uruguay">Uruguay</option>
                </select>
            </div>
            <div class="col-3">
                <select name="sel2[]" id="sel2" class="form-control select2" multiple>
                    <option value="Colombia">Colombia</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Perú">Perú</option>
                    <option value="Brasil">Brasil</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Chile">Chile</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Uruguay">Uruguay</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- BOOTSTRAP JS -->
    <script src="../assets/librerias/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- FONTAWESOME JS -->
    <script src="../assets/librerias/fontawesome/js/all.js"></script>
    <!-- DATATABLE JS -->
    <script src="../assets/librerias/datatable/datatables.js"></script>
    <!-- SELECT2 JS -->
    <script src="../assets/librerias/select2/js/select2.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
</body>
</html>