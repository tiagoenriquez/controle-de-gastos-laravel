@if(isset($sucesso))

<div class="sucesso" id="mensagem">
    <div class="mensagem">{{ $sucesso }}</div>
    <button onclick="fechar()">X</button>
</div>

@endif