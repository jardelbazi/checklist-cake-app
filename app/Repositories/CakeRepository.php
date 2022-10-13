<?php

namespace App\Repositories;

use App\Models\Cake;
use Illuminate\Database\Eloquent\Collection;

class CakeRepository
{
	public function __construct(
		private Cake $cake
	) {}

    public function create(array $data): Cake
	{
		return $this->cake->create($data);
	}

    public function update(int $id, array $data): ?Cake
	{
		$cake = $this->getById($id);

		if (blank($cake))
			return null;

		$cake->update($data);

		return $cake;
	}

    public function delete(int $id): bool
	{
		$cake = $this->getById($id);

		if (blank($cake))
			return false;

		$cake->subscribers()->delete();

		return $cake->delete();
	}

    public function getById(int $id): ?Cake
	{
		return $this->cake->find($id);
	}

    public function getAll(): Collection
	{
		return Cake::all();
	}
}
