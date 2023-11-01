<?php 

namespace App\Core;

abstract class Model 
{
	abstract static function getTable(): string;
	abstract static function getAttributes(): array;

	public static function prepare(string $sql): \PDOStatement
	{
		return Application::$app->database->pdo->prepare($sql);
	}

	public function toArray(): array
	{
		foreach ($this->getAttributes() as $attribute) {
			$data[$attribute] = $this->{$attribute};
		}
		return $data;
	}

	public function primaryKey(): string
	{
		return 'id';
	}

	public static function all(): array
	{
		$statement = self::prepare("SELECT * FROM " . static::getTable());
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
	}

	public static function find(array $where): array
	{
		$sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", array_keys($where)));
		
		$statement = self::prepare("SELECT * FROM " . static::getTable() . " WHERE " . $sql);
		
		foreach ($where as $key => $value) {
			$statement->bindValue(":$key", $value);
		}

		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
	}

	public static function findOneById(int $id): ?static
	{
		$statement = self::prepare("SELECT * FROM " . static::getTable() . " WHERE id = :id");
		$statement->bindValue(":id", $id);
		$statement->execute();
		return $statement->fetchObject(static::class);
	}

	public static function getLastInsertId(): int
	{
		return Application::$app->database->pdo->lastInsertId();
	}

	public static function create(array $data): null|static
	{
		$params = array_map(fn($attr) => ":$attr", static::getAttributes());

		$statement = self::prepare("
			INSERT INTO " . static::getTable() . " 
			(" . implode(',', static::getAttributes()) . ") 
			VALUES (" . implode(',', $params) . ")
		");

		foreach(static::getAttributes() as $attribute) {
			$statement->bindValue(":$attribute", $data[$attribute]);
		}

		$statement->execute();

		if(self::getLastInsertId()) {
			return self::findOneById(self::getLastInsertId());
		}

		return null;
	}

	public static function update(array $where, array $data): array
	{
		$sql = implode(",", array_map(fn($attr) => "$attr = :$attr", array_keys($data)));
		$whereSql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", array_keys($where)));
		
		$statement = self::prepare("UPDATE " . static::getTable() . " SET " . $sql . " WHERE " . $whereSql);
		
		foreach([...$where, ...$data] as $key => $value) {
			$statement->bindValue(":$key", $value);
		}

		$statement->execute();

		return self::find($where);
	}

	public static function delete(array $where): bool
	{
		$sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", array_keys($where)));
		
		$statement = self::prepare("DELETE FROM " . static::getTable() . " WHERE " . $sql);
		
		foreach($where as $key => $value) {
			$statement->bindValue(":$key", $value);
		}

		$statement->execute();

		return true;
	}

}