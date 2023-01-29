<div class="menu">
    <div class="item-de-menu">
        <a href="{{ 
            route('form-edicao-usuario', $usuario->id) 
        }}">
            Atualizar Cadastro
        </a>
    </div>

    @if ($usuario->administrador)

    <div class="item-de-menu">
        <a href="{{ 
            route('form-cadastro-genero') 
        }}">
            Cadastrar Gênero
        </a>
    </div>

    <div class="item-de-menu">
        <a href="{{
            route('lista-generos')
        }}">
            Listar Gêneros
        </a>
    </div>

    <div class="item-de-menu">
        <a href="{{
            route('form-cadastro-item')
        }}">
            Cadastrar Item
        </a>
    </div>

    <div class="item-de-menu">
        <a href="{{
            route('lista-itens')
        }}">
            Listar Itens
        </a>
    </div>

    @endif

    <div class="item-de-menu">
        <a href="{{
            route('form-cadastro-lancamento')
        }}">
            Cadastrar Lançamento
        </a>
    </div>

    <div class="item-de-menu">
        <a href="{{
            route('gastos-do-mes-atual')
        }}">
            Lista de Lançamentos
        </a>
    </div>

    <div class="item-de-menu">
        <a href="{{
            route('dados-do-mes-atual')
        }}">
            Dados
        </a>
    </div>

    <div class="item-de-menu">
        <a href="{{
            route('lancamentos-por-genero-no-mes-atual')
        }}">
            Lançamentos por Gênero
        </a>
    </div>

    <div class="item-de-menu">
        <a href="{{
            route('form-remocao-todos-lancamentos')
        }}">
            Remover todos os lançamentos
        </a>
    </div>

    <div class="item-de-menu">
        <a href="{{ 
            route('logout', $usuario->id)
        }}">
            Logout
        </a>
    </div>
</div>