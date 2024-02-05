<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Services\SupportService;
use Illuminate\Http\Request;


class SupportController extends Controller
{
  //vamos importar o o construtor
  public function __construct(
  //quando ele cria este atributo ($service) ele fez o new e criou uma instência.
  //este atributo ($service) que é um objeto de ( $service)
    protected SupportService $service
  ) { }
    //nosso index irá retornar uma view e ter a listagem dos nossos itens
    public function index(Request $request)
    {
      
        /*
          1º Você pode usar a injeção de depêndencia do Laravel
          e passar no parametro do método=> 
          public function index(Support $support)
          {
             $support = $support->all();
             dd($support);
          }
          a injeção como parametro seria "a mesmo sentido" de criar a instância (new)
        */

         /*
           2º exemplo de como buscar todos na controller
           pego a classe Support e dou um (all ou get) ele me trás todos
           $support = Support::all();
         */
        
         /*
           me retorna uma (collection ou um array)
         */
         //$support = new Support();
         //$supports = $support->all();
         //dd($supports);
        //aqui eu passo o meu path que esta na (view) do projeto
        //nomeDaPasta/nomeDaOutraPasta/nomeDoArquivo sem a extensão blade.php
        //este => compact('supports')seria como a criação de um array para enviar para view.

        //agora por ultimo vou recuperar usando o service
        //passo o (filter) se não tiver nada eu retorno o (null)
        //este retorno é um array
        $supports = $this->service->getAll($request->filter);
        
        return view('/admin/supports/index', compact('supports'));
    }

    public function show (string|int $id)
    {
      //posso fazer esta recuperação de conteudo pelo id de varias maneiras
      //posso até criar uma intancia de ($support  = new Support) e recuperar 
      //posso posso recurperar via injeção de dependencia

      //Outras formas de recuperação falando do Id
      //Support::find($id) quando eu utilizo (find) ele vai na coluna (id => primaryKey) da sua tabela
      //Support::where('id', $id)->first(); quando eu utilizo o where eu posso filtrar por qualquer coluna [id, nome, descrição, data ....]
      //posso tambem filtrar pelo critério de comparação (se eu não passar nada) ele entende que é (igual '=')
      //Support::where('id', $id)->first();
      //Support::where('id', '=', $id)->first(); Onde o id da coluna é igual ao $id vindo pelo (parametro) ou (url)
      //Support::where('id', '!=', $id)->first(); Neste critério de comparação eu passo (!= diferente) e o (firts) é primeiro ou (nullo)
     //if(!$support = Support::find($id))
      //{
        //nesta validação eu verifico se a variavel $support esta vazia
        //ela estando vazia eu dou um retorno back => retorna para ultima url acessada ou de onde ela veio.
          //return back();
      //}
        //fiz a verificação pelo debbug que esta avindo o objeto
        //dd($support);

        //vamos para o exemplo final utilizando a service Layer
        //dd($this->service->findOne($id));
        if(!$support = $this->service->findOne($id))
        {
          return back();
        }
        
        //agora que meu objeto $support esta chegando correto 
        //vou envia-lo para minha view (compact ou em forma de [] array)
        return view('admin/supports/show', compact('support'));
      
    }

    public function create()
    {
        return view('/admin/supports/create');
    }
    
    //este store é o create
    public function store(StoreUpdateSupport $request, Support $support)
    {
        /*
          na nossa refatoraçao trabalhando com DTO
          nesta class CreateSupportDTO eu criei um método makeFromRequest com retorno self
          self seria um objeto da propria classe.
          vamos utiliza-la aqui
          Resumindo: estou acessando o objeto makeFromRequest da minha classe CreateSupportDTO
          */
         $this->service->new(CreateSupportDTO::makeFromRequest($request)
           
         ); 
        return redirect()->route('supports.index');
    }

    //fiz o edti por injeção de dependencia e parametros $id
    public function edit(string $id)
    {
        //buscar o item
        //quando faço com where eu posso filtrar qualquer coluna
        //quando faço o filtro com find() eu só posso filtrar (id ou primaryKey)

        //neste momento no if se não encontrar valor ele dar o return back voutando de onde saiu a (url)
       //if(!$support =  $support->where('id', $id)->first()) {
         //return back();
       //}

       //ultimo exemplo utilizando a service
       if(!$support = $this->service->findOne($id)){
        return back();
       }
       
       //agora ele tendo valor vou enviar via (nome da url) para view
       return view('admin/supports.edit', compact('support'));

        //depois nós vamos popular 
    }



    public function update(StoreUpdateSupport $request)
    {
      
      $support = $this->service->update(
          UpdateSupportDTO::makeFromRequest($request)
                   
        );
        
        if(!$support){
          return back();
        }
        
        //encontrando retorna a nossa view
        return redirect()->route('supports.index');
    }

    //montando a action delete ou destroy
    public function destroy(string|int $id)
    {
      //recuperando dados pelo find
      //lembrando que o find só da para buscar pelo (id ou seja primaryKey) da tabela
      //se eu preciso filtrar por outros campos eu tenho que usar where
      //if(!$support = Support::find($id)){
           //return back();
      //}
      //passando pelo if eu dou um delete no objeto encontrado
      //$support->delete();

      //utilizando a service
      $this->service->delete($id);
      
      //e já faço o redirecionamento pelo nome da rota.
      return redirect()->route('supports.index');
    }
}
