@if(isset($erro))

<div class="erro" id="mensagem">
    <div class="mensagem">{{ $erro }}</div>
    <button onclick="fechar()">X</button>
</div>

@endif