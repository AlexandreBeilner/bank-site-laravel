<?php

namespace App\Http\Controllers;

use App\Application\Billet\Exceptions\BilletNotFoundException;
use App\Application\Billet\UseCases\CreateBillet\CreateBilletHandler;
use App\Application\Billet\UseCases\CreateBillet\CreateBilletRequest;
use App\Application\Billet\UseCases\DestroyBillet\DestroyBilletHandler;
use App\Application\Billet\UseCases\DestroyBillet\DestroyBilletRequest;
use App\Application\Billet\UseCases\ListBillets\ListBilletsHandler;
use App\Application\Billet\UseCases\ListBillets\ListBilletsRequest;
use App\Application\Billet\UseCases\ShowBillet\ShowBilletHandler;
use App\Application\Billet\UseCases\ShowBillet\ShowBilletRequest;
use App\Application\Billet\UseCases\UpdateBillet\UpdateBilletHandler;
use App\Application\Billet\UseCases\UpdateBillet\UpdateBilletRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Billet\StoreBilletRequest;
use App\Http\Requests\Billet\UpdateBilletRequest as UpdateBilletHttpRequest;

class BilletController extends Controller
{
    public function __construct(
        private readonly ListBilletsHandler $listBilletsHandler,
        private readonly ShowBilletHandler $showBilletHandler,
        private readonly CreateBilletHandler $createBilletHandler,
        private readonly UpdateBilletHandler $updateBilletHandler,
        private readonly DestroyBilletHandler $destroyBilletHandler,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Factory|View
    {

        $dto = new ListBilletsRequest(
            search: $request->get('search'),
            page: (int) $request->get('page', 1),
            perPage: (int) $request->get('per_page', 15),
            orderBy: $request->get('order_by', 'payer_name'),
            direction: $request->get('direction', 'asc'),
        );

        $response = $this->listBilletsHandler->handle($dto);

        return view('billets.index', [
            'billets' => $response->paginator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View
    {
        return view('billets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBilletRequest $request): RedirectResponse
    {
        $dto = new CreateBilletRequest(
            payer_name: $request->get('payer_name'),
            payer_document: $request->get('payer_document'),
            recipient_name: $request->get('recipient_name'),
            recipient_document: $request->get('recipient_document'),
            amount: $request->get('amount'),
            expiration_date: $request->get('expiration_date'),
            observations: $request->get('observations'),
            customer_id: $request->get('customer_id'),
            bank_id: $request->get('bank_id'),
        );

        $this->createBilletHandler->handle($dto);

        return redirect()
            ->route('billets.index')
            ->with('success', 'Boleto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse|View
    {
        try {
            $billet = $this->showBilletHandler->handle(new ShowBilletRequest($id))->billet;

            return view('billets.edit', compact('billet'));
        } catch (BilletNotFoundException $e) {
            return redirect()
                ->route('billets.index')
                ->with('error', 'Boleto não encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBilletHttpRequest $request, string $id): RedirectResponse
    {
        $dto = new UpdateBilletRequest(
            id: $id,
            payer_name: $request->get('payer_name'),
            payer_document: $request->get('payer_document'),
            recipient_name: $request->get('recipient_name'),
            recipient_document: $request->get('recipient_document'),
            amount: $request->get('amount'),
            expiration_date: $request->get('expiration_date'),
            observations: $request->get('observations'),
            customer_id: $request->get('customer_id'),
            bank_id: $request->get('bank_id'),
        );

        $this->updateBilletHandler->handle($dto);

        return redirect()
            ->route('billets.index')
            ->with('success', 'Boleto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dto = new DestroyBilletRequest(id: $id);

        try {
            $this->destroyBilletHandler->handle($dto);

            return redirect()
                ->route('billets.index')
                ->with('success', 'Boleto deletado com sucesso.');
        } catch (BilletNotFoundException $e) {
            return redirect()
                ->route('billets.index')
                ->with('error', 'Boleto não encontrado.');
        }
    }
}
