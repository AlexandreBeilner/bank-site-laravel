<?php

namespace App\Http\Controllers;

use App\Application\Bank\Exceptions\BankHasBilletsException;
use App\Application\Bank\Exceptions\BankNotFoundException;
use App\Application\Bank\UseCases\CreateBank\CreateBankHandler;
use App\Application\Bank\UseCases\CreateBank\CreateBankRequest;
use App\Application\Bank\UseCases\DestroyBank\DestroyBankHandler;
use App\Application\Bank\UseCases\DestroyBank\DestroyBankRequest;
use App\Application\Bank\UseCases\ListBanks\ListBanksHandler;
use App\Application\Bank\UseCases\ListBanks\ListBanksRequest;
use App\Application\Bank\UseCases\ShowBank\ShowBankHandler;
use App\Application\Bank\UseCases\ShowBank\ShowBankRequest;
use App\Application\Bank\UseCases\UpdateBank\UpdateBankHandler;
use App\Application\Bank\UseCases\UpdateBank\UpdateBankRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Bank\StoreBankRequest;
use App\Http\Requests\Bank\UpdateBankRequest as UpdateBankHttpRequest;

class BankController extends Controller
{
    public function __construct(
        private readonly ListBanksHandler $listBanksHandler,
        private readonly ShowBankHandler $showBankHandler,
        private readonly CreateBankHandler $createBankHandler,
        private readonly UpdateBankHandler $updateBankHandler,
        private readonly DestroyBankHandler $destroyBankHandler,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Factory|View
    {

        $dto = new ListBanksRequest(
            search: $request->get('search'),
            page: (int) $request->get('page', 1),
            perPage: (int) $request->get('per_page', 15),
            orderBy: $request->get('order_by', 'name'),
            direction: $request->get('direction', 'asc'),
        );

        $response = $this->listBanksHandler->handle($dto);

        return view('banks.index', [
            'banks' => $response->paginator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankRequest $request): RedirectResponse
    {
        $dto = new CreateBankRequest(
            name: $request->input('name'),
            code: $request->input('code'),
            interest_rate: $request->input('interest_rate'),
        );

        $this->createBankHandler->handle($dto);

        return redirect()
            ->route('banks.index')
            ->with('success', 'Banco criado com sucesso.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse|View
    {
        try {
            $bank = $this->showBankHandler->handle(new ShowBankRequest($id))->bank;

            return view('banks.edit', compact('bank'));
        } catch (BankNotFoundException $e) {
            return redirect()
                ->route('banks.index')
                ->with('error', 'Banco não encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBankHttpRequest $request, string $id): RedirectResponse
    {
        $dto = new UpdateBankRequest(
            id: $id,
            name: $request->input('name'),
            code: $request->input('code'),
            interest_rate: $request->input('interest_rate'),
        );

        $this->updateBankHandler->handle($dto);

        return redirect()
            ->route('banks.index')
            ->with('success', 'Banco atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dto = new DestroyBankRequest(id: $id);

        try {
            $this->destroyBankHandler->handle($dto);

            return redirect()
                ->route('banks.index')
                ->with('success', 'Banco deletado com sucesso.');
        } catch (BankNotFoundException $e) {
            return redirect()
                ->route('banks.index')
                ->with('error', 'Banco não encontrado.');
        } catch (BankHasBilletsException $e) {
            return redirect()
                ->route('banks.index')
                ->with('error', 'Não é possível excluir o banco, pois existem boletos vinculados.');
        }
    }
}
