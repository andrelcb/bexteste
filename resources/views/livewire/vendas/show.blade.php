<div class="w-3/6 mx-auto">
    <x-card title="Lista de vendas">
        

        <div class="overflow-auto h-52 mt-4">
            <div class="text-center border shadow text-gray-800 text-2xl p-2">📋 Vendas Cadastradas</div>
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
                        <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">
                            Ação
                        </th>
                    </tr>

                </thead>
                <tbody class="text-sm font-normal text-gray-700 w-full">

                    @foreach ($vendas as $key => $row)
                        <tr class="hover:bg-gray-100 border-b border-gray-200 py-2 ">

                            <td class="px-4 py-1">{{ $row->description }}</td>
                            <td class="px-4 py-1">{{ $row->produtos }}</td>
                            <td class="px-4 py-1">{{ $row->valorTotal }}</td>
                            <td class="px-4 py-1 flex-row">
                                <x-button wire:click="message({{ $row->id }})" icon="x" negative />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $vendas->links() }}
        </div>
    </x-card>
</div>
