<div x-data="{ open: false }" x-cloak class=" flex justify-center mt-4 ">
    <button @click="open = ! open" x-bind:class="[open ? '' : 'animate-pulse']"
        class="text-2xl font-medium rounded-full bg-indigo-600 hover:bg-indigo-500 focus:border-gray-800 text-white p-2.5">
        <x-icon name="clipboard-check" class="w-5 h-5" />
    </button>
    <br>
    <div x-show="open" class="ml-2">
        <x-card>
            📊 Indicador é uma forma de agregar valor para seu cliente, ele traz o que é mais importante e ajuda na
            tomada de decisão.
        </x-card>
    </div>
</div>


<div class="mt-4 w-3/6 sm:w-full mx-auto">
    <x-card class="border-info-800 my-2" title="Indicadores">
        <div wire:loading.class="hidden" class="text-center grid grid-cols-1 sm:grid-cols-2 gap-2">
            <div class=" bg-white p-3 border shadow-md shadow-red rounded-md">
                <p class="font-bold-500 text-xl">{{ $totalProduto }}</p>
                <p class="">Quantidade de Produtos Cadastrado</p>
            </div>

            <div class=" bg-white p-3 border shadow-md shadow-red rounded-md">
                <p class="font-bold-500 text-xl">
                    {{ $produtoMaisCaro ? json_decode($produtoMaisCaro)->name . ' R$ ' . json_decode($produtoMaisCaro)->price : 'Não existe produto' }}
                </p>
                <p class="">Produto Mais Caro</p>
            </div>

            <div class=" bg-white p-3 border shadow-md shadow-red rounded-md">
                <p class="font-bold-500 text-xl">
                    {{ $produtoMaisVendido ? json_decode($produtoMaisVendido)->totalProdutos : 'Não existe produto' }}
                </p>
                <p class="">Produto mais vendido: {{ $produtoMaisVendido ? json_decode($produtoMaisVendido)->name : 'Não existe produto' }}</p>
            </div>
            <div class=" bg-white p-3 border shadow-md shadow-red rounded-md">
                <p class="font-bold-500 text-xl">
                    {{ $produtoMenosVendido ? json_decode($produtoMenosVendido)->totalProdutos : 'Não existe produto' }}
                </p>
                <p class="">Produto menos vendido:
                    {{ $produtoMenosVendido ? json_decode($produtoMenosVendido)->name : 'Não existe produto' }}</p>
            </div>
            <div class=" bg-white p-3 border shadow-md shadow-red rounded-md">
                <p class="font-bold-500 text-xl">
                    {{ $ticketMedio ? $ticketMedio : 'Não existe vendas' }}
                </p>
                <p class="">Ticket medio de vendas</p>
            </div>
        </div>
    </x-card>


    <div class="mt-6">
        <x-card title="Vendas por dia">
            <div class="overflow-auto h-52">
                <div class="text-center border shadow text-gray-800 text-2xl p-2">📊 Vendas por dia</div>
                <table wire:loading.class="hidden" class="table-auto border-collapse w-full mt-4">
                    <thead>
                        <tr class="rounded-lg text-sm font-medium text-gray-700 text-left table-row"
                            style="font-size: 0.9674rem">
                            <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Descrição
                            </th>
                            <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Produtos
                            </th>
                            <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Valor Total
                            </th>
                            <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Data
                            </th>
                        </tr>

                    </thead>
                    <tbody class="text-sm font-normal text-gray-700 w-full">

                        @foreach ($vendasPorDia as $key => $row)
                            <tr class="hover:bg-gray-100 border-b border-gray-200 py-2 ">

                                <td class="px-4 py-1">{{ $row->description }}</td>
                                <td class="px-4 py-1">{{ $row->produtos }}</td>
                                <td class="px-4 py-1">R$ {{ $row->valorTotal }}</td>
                                <td class="px-4 py-1">{{ $row->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $vendasPorDia->links() }}
            </div>
        </x-card>

    </div>

</div>
