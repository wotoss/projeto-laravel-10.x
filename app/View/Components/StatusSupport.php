<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusSupport extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        /*
           no contruttor eu vou receber uma string com o status, 
           porque com este status eu consigo retornar uma class
        */
        protected string $status
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        /*
          fazendo teste, passei o 'C' e rederizei depois passei 'P'
          $this->status = 'P';
        */

        //A (variavel color) eu vou deixar por default sendo blue "azul"
        $color = 'blue';
        //veja aqui esta configuração dos enums - path => App\Enums\SupportStatus
        //se o status for 'C' eu pego este valor e passo ele para (green) : caso contrario eu permaneço com ele na cor default (blue - $color)
        $color = $this->status === 'C' ? 'green' : $color;
        //se o status for 'P' eu pego este valor e passo ele para (red) : caso contrario eu permaneço com ele na cor default (blue - $color)
        $color = $this->status === 'P' ? 'red' : $color;
        
        $textStatus = getStatusSupport($this->status);
        //veja que eu pego este (textStatus) que esta recebendo o Status e passo lá pra view (StatusSupport.php)
        return view('components.status-support', compact('textStatus', 'color'));
    }
}
