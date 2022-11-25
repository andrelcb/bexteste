<div class="w-3/6 mx-auto">
    <form wire:submit.prevent="save">
        <x-card title="Cadastro de vendas">

            <x-select wire:model.defer="produtos" 
            label="Escolha os produtos dessa venda" 
            placeholder="Selecione os produtos" 
            :options="$produtosOptions"
            option-label="name"
            option-value="id"
            multiselect
            />
            <div class="mt-4">
                <x-textarea wire:model.defer="description" label="Descrição:" placeholder="Descrição da venda" />
            </div>

            <x-slot name="footer" class="place-items-end">
                <div class="@if ($produtos) animate-pulse @endif
                    ">
                    <x-button type="submit" spinner="save" primary label="Salvar" />
                </div>
            </x-slot>
        </x-card>
    </form>
</div>
