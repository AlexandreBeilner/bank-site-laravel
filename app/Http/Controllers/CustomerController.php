<?php

namespace App\Http\Controllers;

use App\Application\Customer\Exceptions\CustomerHasBilletsException;
use App\Application\Customer\Exceptions\CustomerNotFoundException;
use App\Application\Customer\UseCases\CreateCustomer\CreateCustomerHandler;
use App\Application\Customer\UseCases\CreateCustomer\CreateCustomerRequest;
use App\Application\Customer\UseCases\DestroyCustomer\DestroyCustomerHandler;
use App\Application\Customer\UseCases\DestroyCustomer\DestroyCustomerRequest;
use App\Application\Customer\UseCases\ListCustomers\ListCustomersHandler;
use App\Application\Customer\UseCases\ListCustomers\ListCustomersRequest;
use App\Application\Customer\UseCases\ShowCustomer\ShowCustomerHandler;
use App\Application\Customer\UseCases\ShowCustomer\ShowCustomerRequest;
use App\Application\Customer\UseCases\UpdateCustomer\UpdateCustomerHandler;
use App\Application\Customer\UseCases\UpdateCustomer\UpdateCustomerRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest as UpdateCustomerHttpRequest;

class CustomerController extends Controller
{
    public function __construct(
        private readonly ListCustomersHandler $listCustomersHandler,
        private readonly ShowCustomerHandler $showCustomerHandler,
        private readonly CreateCustomerHandler $createCustomerHandler,
        private readonly UpdateCustomerHandler $updateCustomerHandler,
        private readonly DestroyCustomerHandler $destroyCustomerHandler,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Factory|View
    {

        $dto = new ListCustomersRequest(
            search: $request->get('search'),
            page: (int) $request->get('page', 1),
            perPage: (int) $request->get('per_page', 15),
            orderBy: $request->get('order_by', 'name'),
            direction: $request->get('direction', 'asc'),
        );

        $response = $this->listCustomersHandler->handle($dto);

        return view('customers.index', [
            'customers' => $response->paginator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        $dto = new CreateCustomerRequest(
            name: $request->input('name'),
            email: $request->input('email'),
        );

        $this->createCustomerHandler->handle($dto);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Cliente criado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse|View
    {
        try {
            $customer = $this->showCustomerHandler->handle(new ShowCustomerRequest($id))->customer;

            return view('customers.edit', compact('customer'));
        } catch (CustomerNotFoundException $e) {
            return redirect()
                ->route('customers.index')
                ->with('error', 'Cliente não encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerHttpRequest $request, string $id): RedirectResponse
    {
        $dto = new UpdateCustomerRequest(
            id: $id,
            name: $request->input('name'),
            email: $request->input('email'),
        );

        $this->updateCustomerHandler->handle($dto);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Cliente atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dto = new DestroyCustomerRequest(id: $id);

        try {
            $this->destroyCustomerHandler->handle($dto);

            return redirect()
                ->route('customers.index')
                ->with('success', 'Cliente deletado com sucesso.');
        } catch (CustomerNotFoundException $e) {
            return redirect()
                ->route('customers.index')
                ->with('error', 'Cliente não encontrado.');
        } catch (CustomerHasBilletsException $e) {
            return redirect()
                ->route('customers.index')
                ->with('error', 'Não é possível excluir o cliente, pois existem boletos vinculados.');
        }
    }
}
