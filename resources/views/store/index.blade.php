<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Virtual</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            
            <h1 class="text-2xl font-bold text-gray-800">
                Loja Virtual
            </h1>

            <div class="space-x-4">
                @guest
                    <a href="{{ route('login') }}"
                       class="text-gray-700 hover:text-black">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                        Registrar
                    </a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}"
                       class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                        Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
            
            <!-- Banner -->
<section class="max-w-7xl mx-auto px-6 py-10">

    <div class="relative rounded-3xl overflow-hidden shadow-2xl">

        <img src="{{ asset('images/banner.jpg') }}"
             class="w-full h-[500px] object-cover">

        <div class="absolute inset-0 bg-black/40 flex items-center">

            <div class="px-12 text-white max-w-2xl">

                <h2 class="text-6xl font-bold mb-6 leading-tight">
                    Produtos incríveis para o seu dia a dia
                </h2>

                <p class="text-xl text-gray-200 mb-8">
                    Descubra ofertas especiais com visual moderno e elegante.
                </p>

                <a href="#produtos"
                   class="bg-white text-black px-8 py-4 rounded-2xl font-semibold hover:bg-gray-200 transition">
                    Ver Produtos
                </a>

            </div>

        </div>

    </div>

</section>

    <!-- Filtro -->
    <section class="max-w-7xl mx-auto px-6 mb-10">

        <form method="GET" action="{{ route('store.index') }}">

            <div class="flex gap-4 items-center">

                <select name="type"
                        class="rounded-xl border-gray-300 shadow-sm w-64">

                    <option value="">
                        Todos os tipos
                    </option>

                    @foreach($types as $type)
                        <option value="{{ $type->id }}"
                            {{ request('type') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach

                </select>

                <button type="submit"
                        class="bg-black text-white px-6 py-2 rounded-xl hover:bg-gray-800 transition">
                    Filtrar
                </button>

            </div>

        </form>

    </section>

    <!-- Produtos -->
    <section id="produtos" class="max-w-7xl mx-auto px-6 pb-16">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            @forelse($products as $product)

                <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition duration-300">

                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-60 object-cover">
                    @else
                        <div class="w-full h-60 bg-gray-200 flex items-center justify-center">
                            Sem imagem
                        </div>
                    @endif

                    <div class="p-6">

                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            {{ $product->name }}
                        </h3>

                        <p class="text-gray-500 text-sm mb-4">
                            {{ $product->description }}
                        </p>

                        <div class="flex justify-between items-center">

                            <span class="text-2xl font-bold text-black">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </span>

                            <span class="text-sm text-gray-500">
                                Estoque: {{ $product->quantity }}
                            </span>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-4 text-center text-gray-500">
                    Nenhum produto encontrado.
                </div>

            @endforelse

        </div>

    </section>
    <footer class="bg-white border-t mt-20">

    <div class="max-w-7xl mx-auto px-6 py-10 text-center text-gray-500">

        <h3 class="text-2xl font-bold text-gray-800 mb-2">
            Loja Virtual
        </h3>

        <p>
            Projeto desenvolvido em Laravel + Tailwind CSS
        </p>

    </div>

</footer>

</body>
</html>