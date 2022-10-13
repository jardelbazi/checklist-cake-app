<?php

namespace App\Services;

use App\Jobs\CakeCreatedJob;
use App\Mail\CakeCreated;
use App\Models\Cake;
use App\Repositories\CakeRepository;
use Illuminate\Database\Eloquent\Collection;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class CakeService
{
	public function __construct(
		private CakeRepository $cakeRepositoy,
		private CakeCreatedJob $cakeCreatedJob,
	) {}

	public function create(array $data): Cake
	{
		$cake = $this->cakeRepositoy->create($data);

		if (filled($data['subscribers'])) {
			foreach ($data['subscribers'] as $subscriber) {
				$subscriber = $cake->subscribers()->create($subscriber);
				dispatch(new CakeCreatedJob($subscriber));
			}
		}

		return $cake;
	}

	public function update(int $id, array $data): Cake
	{
		$cake = $this->cakeRepositoy->update($id, $data);
		throw_if(blank($cake), NotFound::class, $id);

		return $cake;
	}

	public function delete(int $id): void
	{
		$deleted = $this->cakeRepositoy->delete($id);
		throw_if(empty($deleted), NotFound::class, $id);
	}

	public function getById(int $id): Cake
	{
		$cake = $this->cakeRepositoy->getById($id);
		throw_if(blank($cake), NotFound::class, $id);

		return $cake;
	}

	public function getAll(): Collection
	{
		return $this->cakeRepositoy->getAll();
	}
}
