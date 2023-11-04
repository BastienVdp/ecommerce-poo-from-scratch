<?php 

namespace App\Services;

use App\Core\Application;

class FileUploader
{
	public static function upload($file, $path)
	{
		// Vérifiez si le fichier est téléchargé avec succès
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return "Une erreur s'est produite lors du téléchargement du fichier.";
        }

        // Générez un nom de fichier unique pour éviter les collisions
        $uniqueFilename = uniqid() . '_' . $file['name'];

        // Construisez le chemin complet du fichier de destination
        $destination = Application::$root_dir . $path . '/' . $uniqueFilename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $uniqueFilename; // Renvoie le nom du fichier téléchargé
        } else {
            return false;
        }
	}

    public static function delete($file, $path)
    {
        $fullPath = Application::$root_dir . $path . '/' . $file;
        
        if (file_exists($fullPath)) {
            unlink($fullPath);
            return true;
        }
    }
}