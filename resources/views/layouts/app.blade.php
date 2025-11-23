    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bank Site')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-900 text-slate-100">

<div class="min-h-screen flex">
    <aside class="w-64 bg-gray-950 text-slate-100 flex flex-col">
        <div class="h-16 flex items-center justify-center border-b border-slate-800">
            <span class="font-bold text-lg tracking-wide">
                Bank Site
            </span>
        </div>

        <nav class="flex-1 p-3 space-y-1 text-sm">
            <a href="{{ route('customers.index') }}"
               class="flex items-center px-3 py-2 rounded-md font-medium
                    {{ request()->routeIs('customers.*')
                        ? 'bg-orange-500 text-black'
                        : 'text-slate-300 hover:bg-orange-500 hover:text-black' }}">
                <span>Clientes</span>
            </a>

            <a href="{{ route('banks.index') }}"
               class="flex items-center px-3 py-2 rounded-md font-medium
                    {{ request()->routeIs('banks.*')
                        ? 'bg-orange-500 text-black'
                        : 'text-slate-300 hover:bg-orange-500 hover:text-black' }}">
                <span>Bancos</span>
            </a>

            <a href="{{ route('billets.index') }}"
               class="flex items-center px-3 py-2 rounded-md font-medium
                    {{ request()->routeIs('billets.*')
                        ? 'bg-orange-500 text-black'
                        : 'text-slate-300 hover:bg-orange-500 hover:text-black' }}">
                <span>Boletos</span>
            </a>

            <a href="{{ route('billings.index') }}"
               class="flex items-center px-3 py-2 rounded-md font-medium
                    {{ request()->routeIs('billings.*')
                        ? 'bg-orange-500 text-black'
                        : 'text-slate-300 hover:bg-orange-500 hover:text-black' }}">
                <span>Serviços de cobrança</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col">
        <header class="h-16 bg-slate-950/90 border-b border-slate-800 flex items-center px-6">
            <h1 class="text-xl font-semibold text-orange-400">
                @yield('page_title', 'Inicio')
            </h1>
        </header>

        <section class="flex-1 p-6 bg-slate-900">
            @yield('content')
        </section>
    </main>
</div>
@if (session('success'))
    <div
        id="toast-success"
        class="fixed top-4 right-4 bg-green-500 text-black px-4 py-2 rounded shadow-lg text-sm transition-opacity duration-500"
    >
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div
        id="toast-error"
        class="fixed top-4 right-4 bg-red-500 text-black px-4 py-2 rounded shadow-lg text-sm transition-opacity duration-500"
    >
        {{ session('error') }}
    </div>
@endif

<script>
    const TOAST_LIFETIME = 3000;

    function hideToast(id) {
        const toast = document.getElementById(id);
        if (!toast) return;

        toast.style.opacity = '0';

        setTimeout(() => {
            toast.remove();
        }, 500);
    }

    setTimeout(() => hideToast('toast-success'), TOAST_LIFETIME);
    setTimeout(() => hideToast('toast-error'), TOAST_LIFETIME);
</script>
</body>
</html>
