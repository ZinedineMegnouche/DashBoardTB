<?php
    if(!empty($_FILES['avatar']))
    {

        $nameFile = $_FILES['avatar']['name'];
        $typeFile = $_FILES['avatar']['type'];
        $sizeFile = $_FILES['avatar']['size'];
        $tmpFile = $_FILES['avatar']['tmp_name'];
        $errFile = $_FILES['avatar']['error'];

        $extensions = ['pdf'];
        $type = ['application/pdf'];
        $extension = explode('.', $nameFile);
        $max_size = 100000000 ;


        if(in_array($typeFile, $type))
        {
           // if(count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions))
            //{
                if($sizeFile < $max_size)
                {
                    if(move_uploaded_file($tmpFile, 'upload/'.uniqid() . '.' . strtolower(end($extension) ) ) )
                        echo "This is uploaded!";
                    else 
                        echo "failed";
                }
                else 
                {
                    echo "Fichier trop lourd ou format incorrect";
                }
            //}
           /* else 
            {
                echo "Extension failed";
            }*/
        }
        else 
        {
            echo "Type non autorisé";
        }
    }
    else 
    {
        header('Location: index.php');
        die();
    }