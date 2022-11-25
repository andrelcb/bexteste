<?php

namespace App\Http\Livewire\Vendas;

use App\Models\ListaVendas;
use App\Models\Produto;
use Livewire\WithPagination;
use App\Models\Vendas;
use Livewire\Component;
use WireUi\Traits\Actions;

class Show extends Component
{
    use WithPagination;
    use Actions;

    #escuta todos eventos emitidos e toma uma ação
    protected $listeners = [
        'Vendas::create' => '$refresh',
        'Vendas::delete' => '$refresh'
    ];

    # reseta a paginação
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $vendas = Vendas::selectRaw('vendas.id, vendas.description, sum(p.price) as valorTotal, GROUP_CONCAT(p.name) as produtos')
            ->join('lista_vendas as lv', 'lv.vendas_idvendas', 'vendas.id')
            ->join('produtos as p', 'lv.produtos_idprodutos', 'p.id')
            ->orderBy('vendas.id', 'DESC')
            ->groupBy('vendas.id')
            ->paginate(10);

        return view('livewire.vendas.show', ['vendas' => $vendas]);
    }

    public function message(Vendas $vendas)
    {
        $this->dialog()->confirm([
            'title'       => 'Ola, você esta preste a deletar está venda ' . strtoupper($vendas->description),
            'description' => 'Deseja continuar?',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Sim, deletar',
                'method' => 'delete',
                'params' => $vendas,
            ],
            'reject' => [
                'label'  => 'No, cancel',
                'method' => 'render',
            ],
        ]);
    }

    public function delete($id)
    {
        ListaVendas::where('vendas_idvendas', $id)->delete();
        Vendas::where('id', $id)->delete();

        $this->notification()->notify([
            'title'       => 'Sucesso!',
            'description' => 'Seu produto foi deletado',
            'icon'        => 'success',
            'timeout'     =>    1000
        ]);

        $this->emit('Vendas::delete');
    }
}
