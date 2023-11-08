<?php 

namespace App\Services;

use App\Core\Application;

class FileUploader
{
	/**
     * The function takes a file and a path as parameters, checks for any errors during file upload,
     * generates a unique filename, moves the file to the specified destination, and returns the unique
     * filename if successful.
     * 
     * @param file The file parameter is an array that contains information about the uploaded file. It
     * typically includes the following keys:
     * @param path The "path" parameter is the directory where you want to save the uploaded file.
     * 
     * @return either the unique filename if the file was successfully uploaded, or false if there was an
     * error during the upload process.
     */
    public static function upload($file, $path)
	{
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return "Une erreur s'est produite lors du téléchargement du fichier.";
        }

        $uniqueFilename = uniqid() . '_' . $file['name'];

        $destination = Application::$root_dir . $path . '/' . $uniqueFilename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $uniqueFilename; 
        } else {
            return false;
        }
	}

   /**
    * The function deletes a file from a specified path in a PHP application.
    * 
    * @param file The file parameter is the name of the file that you want to delete.
    * @param path The path parameter is the directory path where the file is located.
    * 
    * @return true if the file exists and is successfully deleted.
    */
    public static function delete($file, $path)
    {
        $fullPath = Application::$root_dir . $path . '/' . $file;
        
        if (file_exists($fullPath)) {
            unlink($fullPath);
            return true;
        }
    }
}