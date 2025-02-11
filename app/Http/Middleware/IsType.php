<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->type == 'admin'){
        return $next($request);
    }
    else{
       return redirect('home') ->with('Erro','Voce nao tem acesso faz o Registo/Fale com Admin');
    }
}
}