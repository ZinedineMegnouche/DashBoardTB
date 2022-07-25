    <html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
         <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-5">
                    <form class="form-group" method="POST" action="testAddPdf.php" enctype="multipart/form-data">
                        <div class="d-grid gap-2 col-6 mx-auto mt-5">
                            <input type="file" class="form-control" name="rib" id="rib"  placeholder="">
                        </div>
                        <div class="d-grid gap-2 col-2 mx-auto mt-5">
                            <button class="btn btn-primary" name ="submit" id ="submit" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if(isset($_POST('submit'))){
            $pdf = $_FILES['rib'];
            $nameFile = $_FILES['rib']['name'];
            $typeFile = $_FILES['rib']['type'];
            $sizeFile = $_FILES['rib']['size'];
            $tmpFile = $_FILES['rib']['tmp_name'];
            $errFile = $_FILES['rib']['error'];
            $pdf_store = "upload/".$pdf

            //move_uploaded_file()
        }
        ?>
    </body>
    </html>