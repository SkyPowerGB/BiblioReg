<?php

class FileUpload
{

    public $destination = "../spremiste/";
    public $uploadedFile;


    public $lastUploadFilePath;
    public $uploadErrorMsg;
    public function UploadFile($fileInputName)
    {

          
          if ($_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
            $this->uploadErrorMsg = "Greška prilikom uploadanja datoteke " . $_FILES[$fileInputName]['error'];
            return false;
        }

    
        $tmpFilePath = $_FILES[$fileInputName]['tmp_name'];
    
        $originalFileName = $_FILES[$fileInputName]['name'];
     
        $fileSize = $_FILES[$fileInputName]['size'];
        $fileType = $_FILES[$fileInputName]['type'];

     
     

   
        $newFileName = uniqid() . '-' . basename($originalFileName);
        $targetFilePath = $this->destination . $newFileName;

      
        if (!is_dir($this->destination)) {
            $this->uploadErrorMsg = "Greška";
           return false;
        }

        
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            $this->lastUploadFilePath = $targetFilePath;
            return true;
        }

       
        $this->uploadErrorMsg = "Greška prilikom pomicanja datoteke ";
        return false;
    }

    public $validationErrorMsg;

    public function validateImgFileUpload($fileInputName)
    {
       
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024;  

       
        $fileType = $_FILES[$fileInputName]['type'];
        $fileSize = $_FILES[$fileInputName]['size'];

       
        if (!in_array($fileType, $allowedMimeTypes)) {
            $this->validationErrorMsg = "Nedozvoljen tipDatoteke";
            return false;
        }

       
        if ($fileSize > $maxFileSize) {
            $this->validationErrorMsg = "Datoteka ne smije biti veća od 5MB";
            return false;
        }

        return true;
    }

    public function isFileEmpty($fileInputName) {
        
        if (isset($_FILES[$fileInputName])) {
            if($_FILES[$fileInputName]==null){return true;}
            if($_FILES[$fileInputName] ['type']==null){return true;}
            if ($_FILES[$fileInputName]['error'] === UPLOAD_ERR_NO_FILE) {
                return true; 
            }
            
        
            if ($_FILES[$fileInputName]['size'] == 0) {
                return true; 
            }
        }
        
  
        return false;
    }
    public function DeleteFile($path){
        if(file_exists($path)){
     if($path!=$this->avatarDefaultPth){
        unlink($path);
     }}
    }
   

    public $avatarDefaultPth="../spremiste/avatarDefault.png";



}