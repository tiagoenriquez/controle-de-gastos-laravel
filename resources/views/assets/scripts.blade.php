<script>
    function fechar() {
        const el = document.getElementById("mensagem");
        const parent = el.parentNode;
        parent.removeChild(el);
    }

    function validarValor() {
        const algorismos = '0123456789,';
        const element = document.getElementById('valor');
        const valor = element.value;
        for (let i = 0; i < valor.length; i++) {
            if (!algorismos.includes(valor[i])) {
                element.value = '';
            }
        }
    }
</script>