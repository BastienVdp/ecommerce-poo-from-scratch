<?php 

namespace App\Trait;

use App\Core\Application;
use App\Core\Model;

trait Relationship 
{
	// users : id, name, email, password
	// posts : id, title, content, user_id
	// $model = 
	public function getForeignKey(Model $model)
	{
		$tableName = preg_replace('/s$/', '', $model::getTable());
		$primaryKey = $model->primaryKey();
		return strtolower($tableName . "_$primaryKey");
	}

	public function hasMany(string $model, string $foreignKey = null)
	{
		$relatedTableName = $model::getTable();
		$foreignModelKey = !$foreignKey ? $this->getForeignKey($this) : $foreignKey;

		$statement = self::prepare("SELECT * FROM $relatedTableName WHERE $foreignModelKey = :id");
		$statement->bindValue(':id', $this->id);
		$statement->execute();

    return $statement->fetchAll(\PDO::FETCH_CLASS, $model);
	}

	public function belongsTo(string $model, $primaryKey = null)
	{
		$relatedTableName = $model::getTable();
		$instanceModel = new $model;
		$primaryModelKey = !$primaryKey ? $instanceModel->primaryKey() : $primaryKey;
	
		// Utilisez la clé étrangère de la relation
		$foreignModelKey = $this->getForeignKey(new $model);
	
		// var_dump($relatedTableName, $primaryModelKey, $foreignModelKey);exit;
		$statement = self::prepare("SELECT * FROM $relatedTableName WHERE $primaryModelKey = :foreignkey");
	
		// Utilisez la valeur de l'ID du produit
		$statement->bindValue(':foreignkey', $this->$foreignModelKey);
		$statement->execute();
	
		return $statement->fetchObject($model);
	}
}