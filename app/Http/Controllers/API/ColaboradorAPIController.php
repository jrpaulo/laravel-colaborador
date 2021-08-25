<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateColaboradorAPIRequest;
use App\Http\Requests\API\UpdateColaboradorAPIRequest;
use App\Models\Colaborador;
use App\Repositories\ColaboradorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ColaboradorController
 * @package App\Http\Controllers\API
 */

class ColaboradorAPIController extends AppBaseController
{
    /** @var  ColaboradorRepository */
    private $colaboradorRepository;

    public function __construct(ColaboradorRepository $colaboradorRepo)
    {
        $this->colaboradorRepository = $colaboradorRepo;
    }

    /**
     * Display a listing of the Colaborador.
     * GET|HEAD /colaboradors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $colaboradors = $this->colaboradorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($colaboradors->toArray(), 'Colaboradors retrieved successfully');
    }

    public function buscaColaboradorSalarios($id, Request $request)
    {
        $colaboradors = Colaborador::with(['salarios'])
            ->where(function ($query) use($id) {
                $query->where('id_colaborador',       $id)
                  ->orWhere('cpf',       $id);
            })->get();

        return $this->sendResponse($colaboradors->toArray(), 'Colaboradors retrieved successfully');
    }

    /**
     * Store a newly created Colaborador in storage.
     * POST /colaboradors
     *
     * @param CreateColaboradorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateColaboradorAPIRequest $request)
    {
        $input = $request->all();

        if(Colaborador::where([
                ['cpf', $input['cpf'] ]
            ])->exists())
                {
                    return $this->sendError("CPF ". $input['numero'] . " já cadastrado" );
                }

        if(Colaborador::where([
            ['email', $input['email'] ]
        ])->exists())
            {
                return $this->sendError("E-Mail ". $input['email'] . " já cadastrado" );
            }

        $colaborador = $this->colaboradorRepository->create($input);

        return $this->sendResponse($colaborador->toArray(), 'Colaborador saved successfully');
    }

    /**
     * Display the specified Colaborador.
     * GET|HEAD /colaboradors/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Colaborador $colaborador */
        $colaborador = $this->colaboradorRepository->find($id);

        if (empty($colaborador)) {
            return $this->sendError('Colaborador not found');
        }

        return $this->sendResponse($colaborador->toArray(), 'Colaborador retrieved successfully');
    }

    /**
     * Update the specified Colaborador in storage.
     * PUT/PATCH /colaboradors/{id}
     *
     * @param int $id
     * @param UpdateColaboradorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateColaboradorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Colaborador $colaborador */
        $colaborador = $this->colaboradorRepository->find($id);

        if (empty($colaborador)) {
            return $this->sendError('Colaborador not found');
        }

        $colaborador = $this->colaboradorRepository->update($input, $id);

        return $this->sendResponse($colaborador->toArray(), 'Colaborador updated successfully');
    }

    /**
     * Remove the specified Colaborador from storage.
     * DELETE /colaboradors/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Colaborador $colaborador */
        $colaborador = $this->colaboradorRepository->find($id);

        if (empty($colaborador)) {
            return $this->sendError('Colaborador not found');
        }

        $colaborador->delete();

        return $this->sendSuccess('Colaborador deleted successfully');
    }
}
