<?php

namespace App\Http\Controllers;

use App\DataTables\ConversionsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateConversionsRequest;
use App\Http\Requests\UpdateConversionsRequest;
use App\Repositories\ConversionsRepository;
use Flash;
use Carbon\Carbon;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Coins;

class ConversionsController extends AppBaseController
{
    /** @var  ConversionsRepository */
    private $conversionsRepository;

    public function __construct(ConversionsRepository $conversionsRepo)
    {
        $this->conversionsRepository = $conversionsRepo;
    }

    /**
     * Display a listing of the Conversions.
     *
     * @param ConversionsDataTable $conversionsDataTable
     * @return Response
     */
    public function index(ConversionsDataTable $conversionsDataTable)
    {
        return $conversionsDataTable->render('conversions.index');
    }

    /**
     * Show the form for creating a new Conversions.
     *
     * @return Response
     */
    public function create()
    {
        $coins = Coins::all();
        return view('conversions.create', compact('coins'));
    }

    /**
     * Store a newly created Conversions in storage.
     *
     * @param CreateConversionsRequest $request
     *
     * @return Response
     */
    public function store(CreateConversionsRequest $request)
    {
        $input = $request->all();

        $input['value_conversion'] = str_replace(',', '.', str_replace('.', '',$request->value_conversion));

        $input['user_id'] = auth()->user()->id;

        $coin = Coins::find($input['coin_id']);
        $coin_conversion = Coins::find($input['coin_conversion_id']);

        $priceResult = $this->conversionsRepository->requestConversion(
            $coin->code,
            $coin_conversion->code,
            $input['value_conversion'],
            $input['date_conversion']
        );

        if($priceResult)
        {

            $input['price_conversion'] = $priceResult;            

        }else{

            Flash::error('Cotação não encontrada!');

            return redirect(route('conversions.index'));

        }

        $conversions = $this->conversionsRepository->create($input);

        Flash::success('Conversions saved successfully.');

        return redirect(route('conversions.index'));
    }

    /**
     * Display the specified Conversions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $conversions = $this->conversionsRepository->find($id);

        $coin = Coins::find($conversions->coin_id);
        $coin_conversion = Coins::find($conversions->coin_conversion_id);

        if (empty($conversions)) {
            Flash::error('Conversions not found');

            return redirect(route('conversions.index'));
        }

        return view('conversions.show')->with('conversions', $conversions)->with('coin',$coin)->with('coin_conversion',$coin_conversion);
    }

    /**
     * Show the form for editing the specified Conversions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $conversions = $this->conversionsRepository->find($id);

        $coins = Coins::all();

        if (empty($conversions)) {
            Flash::error('Conversions not found');

            return redirect(route('conversions.index'));
        }

        return view('conversions.edit')->with('conversions', $conversions)->with('coins',$coins);
    }

    /**
     * Update the specified Conversions in storage.
     *
     * @param  int              $id
     * @param UpdateConversionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConversionsRequest $request)
    {
        $conversions = $this->conversionsRepository->find($id);

        if (empty($conversions)) {
            Flash::error('Conversions not found');

            return redirect(route('conversions.index'));
        }

        $conversions = $this->conversionsRepository->update($request->all(), $id);

        Flash::success('Conversions updated successfully.');

        return redirect(route('conversions.index'));
    }

    /**
     * Remove the specified Conversions from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $conversions = $this->conversionsRepository->find($id);

        if (empty($conversions)) {
            Flash::error('Conversions not found');

            return redirect(route('conversions.index'));
        }

        $this->conversionsRepository->delete($id);

        Flash::success('Conversions deleted successfully.');

        return redirect(route('conversions.index'));
    }
}
