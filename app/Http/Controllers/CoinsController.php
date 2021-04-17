<?php

namespace App\Http\Controllers;

use App\DataTables\CoinsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCoinsRequest;
use App\Http\Requests\UpdateCoinsRequest;
use App\Repositories\CoinsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CoinsController extends AppBaseController
{
    /** @var  CoinsRepository */
    private $coinsRepository;

    public function __construct(CoinsRepository $coinsRepo)
    {
        $this->coinsRepository = $coinsRepo;
    }

    /**
     * Display a listing of the Coins.
     *
     * @param CoinsDataTable $coinsDataTable
     * @return Response
     */
    public function index(CoinsDataTable $coinsDataTable)
    {
        return $coinsDataTable->render('coins.index');
    }

    /**
     * Show the form for creating a new Coins.
     *
     * @return Response
     */
    public function create()
    {
        return view('coins.create');
    }

    /**
     * Store a newly created Coins in storage.
     *
     * @param CreateCoinsRequest $request
     *
     * @return Response
     */
    public function store(CreateCoinsRequest $request)
    {
        $input = $request->all();

        $coins = $this->coinsRepository->create($input);

        Flash::success('Coins saved successfully.');

        return redirect(route('coins.index'));
    }

    /**
     * Display the specified Coins.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coins = $this->coinsRepository->find($id);

        if (empty($coins)) {
            Flash::error('Coins not found');

            return redirect(route('coins.index'));
        }

        return view('coins.show')->with('coins', $coins);
    }

    /**
     * Show the form for editing the specified Coins.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $coins = $this->coinsRepository->find($id);

        if (empty($coins)) {
            Flash::error('Coins not found');

            return redirect(route('coins.index'));
        }

        return view('coins.edit')->with('coins', $coins);
    }

    /**
     * Update the specified Coins in storage.
     *
     * @param  int              $id
     * @param UpdateCoinsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCoinsRequest $request)
    {
        $coins = $this->coinsRepository->find($id);

        if (empty($coins)) {
            Flash::error('Coins not found');

            return redirect(route('coins.index'));
        }

        $coins = $this->coinsRepository->update($request->all(), $id);

        Flash::success('Coins updated successfully.');

        return redirect(route('coins.index'));
    }

    /**
     * Remove the specified Coins from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coins = $this->coinsRepository->find($id);

        if (empty($coins)) {
            Flash::error('Coins not found');

            return redirect(route('coins.index'));
        }

        $this->coinsRepository->delete($id);

        Flash::success('Coins deleted successfully.');

        return redirect(route('coins.index'));
    }
}
