<?php

namespace App\Http\Livewire\Vendas;

use App\Models\ListaVendas;
use App\Models\Produto;
use App\Models\Vendas;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;
    public $produtos;
    public string $description = "";


    # "parse para portugues" das mensagem de erro
    protected $messages = [
        'produtos.required' => 'Escolha um produto.',
    ];

    protected $rules = [
        'produtos' => ['required'],

    ];

    public function render()
    {
        $produtosOptions = Produto::select('id', 'name')->orderBy('id', 'DESC')->get();

        return view('livewire.vendas.create', ['produtosOptions' => $produtosOptions]);
    }


    #metodo para salvar no banco de dados
    public function save(): void
    {
        $this->validate();

        $vendas = Vendas::query()->create([
            'description' => $this->description
        ]);

        if ($vendas->id) {
            foreach ($this->produtos as $value) {
                ListaVendas::query()->create([
                    'produtos_idprodutos' => $value,
                    'vendas_idvendas' => $vendas->id
                ]);
            }
        }

        $this->notification()->notify([
            'title'       => 'Sucesso!',
            'description' => 'Sua Venda foi salvo com sucesso',
            'icon'        => 'success',
            'timeout'     =>  2000

        ]);

        #emite um evento de crate do produto
        $this->emit('Vendas::create');
        $this->clean();
    }

    private function clean()
    {
        $this->produtos = [];
        $this->description = "";
    }
}
