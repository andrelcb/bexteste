<?php

namespace App\Http\Livewire\Indicador;

use App\Models\ListaVendas;
use App\Models\Produto;
use App\Models\Vendas;
use Livewire\Component;

use function PHPSTORM_META\map;

class Indicador extends Component
{
    public int $totalProduto;
    public string $produtoMaisVendido;
    public string $produtoMenosVendido;
    public string $produtoMaisCaro;
    public int $ticketMedio;

    protected $listeners = [
        'Produto::create' => '$refresh',
        'Produto::delete' => '$refresh'
    ];


    public function mount()
    {
        $this->totalProduto = Produto::count();
        $totalVendas = Vendas::count();

        if ($totalVendas) {
            $faturamentoTotal = ListaVendas::selectRaw('SUM(produtos.price) as preco')
                ->join('produtos', 'produtos.id', 'lista_vendas.produtos_idprodutos')
                ->first();

            $this->ticketMedio = $faturamentoTotal->preco / $totalVendas;
        }

        if ($this->totalProduto) {
            $this->produtoMaisCaro = Produto::select('name', 'price')
                ->orderBy('price', 'desc')
                ->first();

            $this->produtoMaisVendido = ListaVendas::selectRaw('count(produtos_idprodutos) as totalProdutos, produtos.name')
                ->join('produtos', 'produtos.id', 'lista_vendas.produtos_idprodutos')
                ->orderBy('totalProdutos', 'desc')
                ->groupBy('produtos_idprodutos')
                ->first();

            $this->produtoMenosVendido = ListaVendas::selectRaw('count(produtos_idprodutos) as totalProdutos, produtos.name')
                ->join('produtos', 'produtos.id', 'lista_vendas.produtos_idprodutos')
                ->orderBy('totalProdutos', 'asc')
                ->groupBy('produtos_idprodutos')
                ->first();
        }
    }

    public function render()
    {
        $vendasPorDia = Vendas::selectRaw('vendas.id, vendas.description, sum(p.price) as valorTotal, GROUP_CONCAT(p.name) as produtos, vendas.created_at')
            ->join('lista_vendas as lv', 'lv.vendas_idvendas', 'vendas.id')
            ->join('produtos as p', 'lv.produtos_idprodutos', 'p.id')
            ->orderBy('created_at', 'DESC')
            ->groupBy('vendas.id')
            ->paginate(10);

        return view('livewire.indicador.indicador', ['vendasPorDia' => $vendasPorDia]);
    }
}
