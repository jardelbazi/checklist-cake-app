<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCakeRequest;
use App\Http\Resources\CakeResource;
use App\Services\CakeService;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class CakeController extends Controller
{
    public function __construct(
		protected CakeService $cakeService
	) {}

	public function store(StoreCakeRequest $request): Response
	{
		$content = new CakeResource(
			$this->cakeService->create($request->validated())
		);

		return response($content, Response::HTTP_CREATED);
	}

	public function update(StoreCakeRequest $request, $id): CakeResource
	{
		return new CakeResource(
			$this->cakeService->update($id, $request->validated())
		);
	}

	public function destroy($id): Response
	{
		$this->cakeService->delete($id);

		return response('', Response::HTTP_NO_CONTENT);
	}

	public function show($id): CakeResource
	{
		return new CakeResource(
			$this->cakeService->getById($id)
		);
	}

	public function index(): ResourceCollection
	{
		return CakeResource::collection($this->cakeService->getAll());
	}
}
