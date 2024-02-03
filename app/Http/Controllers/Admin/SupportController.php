<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
 //as validações estão centralizadas nesta classe StoreUpdateSupport
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
  //vamos importar o o construtor
  public function __construct(
  //quando ele cria este atributo ($service) ele fez o new e criou uma instência.
  //este atributo ($service) que é um objeto de ( $service)
    protected SupportController $service
  )
  { }
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
        $support = $this->service->getAll($request->filter);
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
      //validated -> pegar os dados que foram validados.
        $data = $request->validated();
        $data['status'] = 'a';

        //aqui eu faço o cadastro
        //Support::create($data);

        //$support = $support->create($data);
        
        //vou enviar para view esta lista, passando o nome da rota não a (url)
        //o nome da rota sempre fica a url pode ser alterada, e mudar o projeto
        $support->create($data);
        
        return redirect()->route('supports.index');


        //podemos usar via injeção de dependencia (parametros)
        //ou criar a instancia do Request
        //$request = new Request();
        //com este request.all eu pego todos os dados que vem da reuisição
        //dd($request->all());
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

    public function update(StoreUpdateSupport $request, Support $support, string|int $id)
    {
      //vamos verificar se existe
      if(!$support = $support->find($id))
      {
        return back();
      }
      //fiz via injeção de dependencia poderia fazer via instancia
      //só que especifiquei o que eu quero que (atualize) montei um array only[]

      //somente lembrando que o método (update) retorna true se deu certo e false caso não atualize.
      //da uma expection caso de alguma excessão com base de dados ou seja o false.

      //este fica como exemplo sem a validação
        // $support->update($request->only([
        //  'subject', 'body'
        //]));

        //este já com a validated eu pego apenas os dados que foram validados.
        $support->update($request->validated());


        /*2º meio de atualizar sem array é mais verboso 

        //outro exemplo ao invês de fazer via array poderia fazer manualmente
        //este modelo tanto server para (edição como para cadastro)

        //$support->subjcet = $request->subject;
        //$support->body = $request->body;
        //$support->save();

        */
        //dando tudo certo eu retorno par listagem com o objteo atualizado
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
