<?php

namespace App\Http\Controllers;

use App\Application\Bank\UseCases\ListBanks\ListBanksHandler;
use App\Application\Bank\UseCases\ListBanks\ListBanksRequest;
use App\Application\Billing\UseCases\CreateBilling\CreateBillingHandler;
use App\Application\Billing\UseCases\CreateBilling\CreateBillingRequest;
use App\Application\Billing\UseCases\ListBillings\ListBillingsHandler;
use App\Application\Billing\UseCases\ListBillings\ListBillingsRequest;
use App\Application\Customer\UseCases\ListCustomers\ListCustomersHandler;
use App\Application\Customer\UseCases\ListCustomers\ListCustomersRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Billing\StoreBillingRequest;

class BillingController extends Controller
{
    public function __construct(
        private readonly ListBillingsHandler $listBillingsHandler,
        private readonly CreateBillingHandler $createBillingHandler,
        private readonly ListCustomersHandler $listCustomersHandler,
        private readonly ListBanksHandler $listBanksHandler,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Factory|View
    {

        $dto = new ListBillingsRequest(
            search: $request->get('search'),
            page: (int) $request->get('page', 1),
            perPage: (int) $request->get('per_page', 15),
            orderBy: $request->get('order_by', 'description'),
            direction: $request->get('direction', 'asc'),
        );

        $response = $this->listBillingsHandler->handle($dto);

        return view('billings.index', [
            'billings' => $response->paginator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View
    {
        $customersResponse = $this->listCustomersHandler->handle(
            new ListCustomersRequest(
                search: null,
                page: 1,
                perPage: 1000,
                orderBy: 'name',
                direction: 'asc',
            )
        );

        $banksResponse = $this->listBanksHandler->handle(
            new ListBanksRequest(
                search: null,
                page: 1,
                perPage: 1000,
                orderBy: 'name',
                direction: 'asc',
            )
        );

        return view('billings.create', [
            'customers' => $customersResponse->paginator->items(),
            'banks' => $banksResponse->paginator->items(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillingRequest $request): RedirectResponse
    {
        $dto = new CreateBillingRequest(
            description: $request->get('description'),
            customer_id: $request->get('customer_id'),
            bank_id: $request->get('bank_id'),
            total_amount: $request->get('total_amount'),
            installments: $request->get('installments'),
            first_due_date: $request->get('first_due_date'),
            periodicity: $request->get('periodicity'),
        );

        $this->createBillingHandler->handle($dto);

        return redirect()
            ->route('billings.index')
            ->with('success', 'Serviço de cobrança criado com sucesso.');
    }

}
