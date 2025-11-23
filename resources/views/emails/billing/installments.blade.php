@component('mail::message')
    # Parcelas do serviço de cobrança

    Olá {{ $customer->name }},

    Seguem as parcelas do serviço de cobrança **{{ $service->description }}**.

    @component('mail::table')
        | Parcela | Valor | Vencimento |
        |:------:|------:|-----------:|
        @foreach ($installments as $installment)
            | {{ $installment->number }} | R$ {{ number_format($installment->amount, 2, ',', '.') }} | {{ \Carbon\Carbon::parse($installment->due_date)->format('d/m/Y') }} |
        @endforeach
    @endcomponent

    Caso já tenha efetuado o pagamento, desconsidere este e-mail.

@endcomponent
