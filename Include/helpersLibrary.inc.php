<?php
function formSelectDepuisRecordset($unLabel, $unNom, $id, $unRecordset, $tabIndex, $placeholder = null,$valeurOptionSelec = null)
{  
    $codeHTML = '<label for="' . $id . '">' . $unLabel . '</label>'
                . '<select name="' . $unNom . '"id="' . $id . '"tabIndex ="' . $tabIndex . '">' . "\n";
    $unRecordset->setFetchMode(PDO::FETCH_NUM);
    $ligne = $unRecordset->fetch();
    while ($ligne != false) 
    {
        if (isset($valeurOptionSelec) && $valeurOptionSelec == $ligne[0])
        {
            $codeHTML = $codeHTML . '<option value="' . $ligne[0] . '" selected="selected">' . $ligne[1] . '</option>';
        }
        else
        {
            $codeHTML = $codeHTML . '<option value="' . $ligne[0] . '">' . $ligne[1] . '</option>' . "\n";
        }
        $ligne = $unRecordset->fetch();
    }
    $codeHTML = $codeHTML . '</select>' . "\n";
    return $codeHTML;
}
function formInputText($leLabel, $leNom, $id, $valeur, $taille, $longueurMax, $tabIndex, $lectureSeule,$obligation= null)
{
    $codeHTML = '<label for="' . $id . '">' . $leLabel . ' : </label> '
         . '<input type="text" name="' . $leNom . '"id="' . $id . '"size="' . $taille . '"'
         . 'maxlength="' . $longueurMax . '"value="' . $valeur . '"tabIndex="' . $tabIndex . '"'; 
     
    if ($lectureSeule == true)
    {
        $codeHTML = $codeHTML . ' readonly="readonly" ';
    }
    if($obligation==true)
    {
         $codeHTML = $codeHTML . ' required="required" ';
    }
    $codeHTML = $codeHTML . '/>';
    
    return $codeHTML;
}
function formInputText2($leLabel, $leNom, $id, $valeur, $taille,$longueurmin,$longueurMax, $tabIndex, $lectureSeule,$obligation= null, $placeholder = null)
{
    $codeHTML = '<label for="' . $id . '">' . $leLabel . ' : </label> '
         . '<input type="text" name="' . $leNom . '"id="' . $id . '"size="' . $taille . '"'
         . 'maxlength="' . $longueurMax . '" minlength="'.$longueurmin.'" value="' . $valeur . '" tabIndex="' . $tabIndex . '"'; 
     
    if ($lectureSeule == true)
    {
        $codeHTML = $codeHTML . ' readonly="readonly" ';
    }
    if($obligation==true)
    {
         $codeHTML = $codeHTML . ' required="required" ';
    }
    if($placeholder != null){
        $codeHTML = $codeHTML . ' placeholder="'.$placeholder.' "';
    }
    $codeHTML = $codeHTML . '/>';
    $codeHTML = $codeHTML.'<br>';
    
    return $codeHTML;
}
function formBoutonSubmit($name, $id, $value ,$tabIndex)
{
    return '<input type="submit" id="' . $id . '" name="' . $name . '" value="' . $value . '" tabindex="' . $tabIndex . '">';                     
}
     
function  formInputHidden ($name , $id , $value)
{
    return '<input type="hidden" id="' . $id . '" name="' . $name . '" value="' . $value.'">';    
}  

?>