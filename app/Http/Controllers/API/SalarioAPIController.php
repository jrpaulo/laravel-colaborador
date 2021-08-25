<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSalarioAPIRequest;
use App\Http\Requests\API\UpdateSalarioAPIRequest;
use App\Models\Salario;
use App\Repositories\SalarioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SalarioController
 * @package App\Http\Controllers\API
 */

class SalarioAPIController extends AppBaseController
{
    /** @var  SalarioRepository */
    private $salarioRepository;

    public function __construct(SalarioRepository $salarioRepo)
    {
        $this->salarioRepository = $salarioRepo;
    }

    /**
     * Display a listing of the Salario.
     * GET|HEAD /salarios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $salarios = $this->salarioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($salarios->toArray(), 'Salarios retrieved successfully');
    }

    /**
     * Store a newly created Salario in storage.
     * POST /salarios
     *
     * @param CreateSalarioAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSalarioAPIRequest $request)
    {
        $input = $request->all();

        $salario = $this->salarioRepository->create($input);

        return $this->sendResponse($salario->toArray(), 'Salario saved successfully');
    }

    /**
     * Display the specified Salario.
     * GET|HEAD /salarios/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Salario $salario */
        $salario = $this->salarioRepository->find($id);

        if (empty($salario)) {
            return $this->sendError('Salario not found');
        }

        return $this->sendResponse($salario->toArray(), 'Salario retrieved successfully');
    }

    /**
     * Update the specified Salario in storage.
     * PUT/PATCH /salarios/{id}
     *
     * @param int $id
     * @param UpdateSalarioAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSalarioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Salario $salario */
        $salario = $this->salarioRepository->find($id);

        if (empty($salario)) {
            return $this->sendError('Salario not found');
        }

        $salario = $this->salarioRepository->update($input, $id);

        return $this->sendResponse($salario->toArray(), 'Salario updated successfully');
    }

    /**
     * Remove the specified Salario from storage.
     * DELETE /salarios/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Salario $salario */
        $salario = $this->salarioRepository->find($id);

        if (empty($salario)) {
            return $this->sendError('Salario not found');
        }

        $salario->delete();

        return $this->sendSuccess('Salario deleted successfully');
    }
}
