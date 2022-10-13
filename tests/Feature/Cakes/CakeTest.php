<?php

namespace Tests\Feature\Cakes\Integrations;

use App\Models\{
	Cake,
    CakeSubscriber
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CakeTest extends TestCase
{
	use RefreshDatabase, WithFaker;

	protected mixed $cake;

	protected function setUp(): void
	{
		parent::setUp();

		$this->cake = Cake::factory()->create();

		$this->withoutExceptionHandling();
	}

	public function getJsonStructure(): array
	{
		return [
			'name',
			'weight',
			'price',
			'quantity',
			'is_available',
		];
	}

	/** @test */
	public function testMustCreateACake()
	{
		$response = $this->post(route('api.cake.store'), $this->cake->toArray());

		$response
			->assertCreated()
			->assertJsonStructure(
				$this->getJsonStructure()
			);
	}

	/** @test */
	public function testMustCreateACakeWithSubscribers()
	{
		$data = $this->cake->toArray();
		$data['subscribers'] = CakeSubscriber::factory(10)->create(['cake_id' => $this->cake->id])->toArray();

		$response = $this->post(route('api.cake.store'), $data);

		$response
			->assertCreated()
			->assertJsonStructure(
				$this->getJsonStructure()
			);
	}

	/** @test */
	public function testMustUpdateACake()
	{
		$newCakename = 'New Cake';
		$response = $this->put(route('api.cake.update', $this->cake->id), [
			'name' => $newCakename
		]);

		$response->assertStatus(Response::HTTP_OK);
		$this->assertDatabaseHas('cakes', ['name' => $newCakename]);
	}

	/** @test */
	public function testMustDeleteACake()
	{
		$response = $this->delete(route('api.cake.update', $this->cake->id));

		$response
			->assertStatus(Response::HTTP_NO_CONTENT)
			->assertNoContent();
	}

	/** @test */
	public function testMustListACake()
	{
		$response = $this->get(route('api.cake.show', $this->cake->id));

		$response
			->assertStatus(Response::HTTP_OK)
			->assertJsonStructure([
				'data' => $this->getJsonStructure()
			]);
	}

	/** @test */
	public function testShouldListAllCakes()	{
		$response = $this->get(route('api.cake.index'));

		$response
			->assertStatus(Response::HTTP_OK)
			->assertJsonStructure([
				'data' => [
					$this->getJsonStructure()
				]
			]);
	}
}
