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

	public function belongsTo(string $model, $foreignKey = null)
	{
		$relatedTableName = $model::getTable();
		$instanceModel = new $model;
		$primaryModelKey = $instanceModel->primaryKey();
	
		// Utilisez la clé étrangère de la relation
		$foreignModelKey = !$foreignKey ? $this->getForeignKey(new $model) : $foreignKey;
			
		// var_dump($relatedTableName, $primaryModelKey, $foreignModelKey);exit;
		$statement = self::prepare("SELECT * FROM $relatedTableName WHERE $primaryModelKey = :foreignkey");
	
		// Utilisez la valeur de l'ID du produit
		$statement->bindValue(':foreignkey', $this->$foreignModelKey);
		$statement->execute();
	
		return $statement->fetchObject($model);
	}

	public function belongsToMany(string $model, string $pivotTable, $foreignKey = null)
	{
		$relatedTableName = $model::getTable();
		$pivotForeignKey = $this->getForeignKey($this);
		$relatedForeignKey = $this->getForeignKey(new $model);

		$statement = self::prepare("SELECT $relatedTableName.* FROM $relatedTableName
			JOIN $pivotTable ON $relatedTableName.id = $pivotTable.$relatedForeignKey
			WHERE $pivotTable.$pivotForeignKey = :id");

		$statement->bindValue(':id', $this->id);
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_CLASS, $model);
	}

	public function associate(string $model, array $data): array|static
    {
        $pivotTable = str_replace('s', '', $this->getTable()) . "_" . str_replace('s', '', $model::getTable());
        $pivotForeignKey = $this->getForeignKey($this);
        $relatedForeignKey = $this->getForeignKey(new $model);

		foreach($data as $key => $value) {
			$statement = self::prepare("INSERT INTO $pivotTable ($pivotForeignKey, $relatedForeignKey) VALUES (:id, :relatedId)");

			$statement->bindValue(':id', $this->id);
			$statement->bindValue(':relatedId', $value['id']);

			$statement->execute();
		}

        return $this->find(['id' => $this->id]);
    }
}