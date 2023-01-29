<style type="text/css">
    :root {
        --amarelo: rgb(246, 200, 98);
        --amarelo-claro: rgb(250, 227, 176);
        --amarelo-escuro: rgb(123, 100, 49);
        --amarelo-muito-claro: rgb(252, 241, 215);
        --amarelo-muito-escuro: rgb(61, 50, 24);
        --amarelo-pouco-claro: rgb(248, 213, 137);
        --amarelo-pouco-escuro: rgb(184, 150, 73);
        --cor-erro: rgb(246, 98, 98);
        --cor-sucesso: rgb(98, 149, 98);
        --fonte: serif;
        --margin-pequena: 4px 4px 4px 4px;
        --margin-grande: 8px 8px 8px 8px;
        --padding-pequena: 4px 4px 4px 4px;
        --padding-grande: 8px 8px 8px 8px;
        --padding-texto: 4px 8px 4px 8px;
        --tamanho-da-fonte: 16px;
    }

    body {
        display: flex;
        flex-direction: row;
        background-color: var(--amarelo);
        margin: 0px;
        padding: 0px;
    }

    .menu {
        background-color: var(--amarelo-muito-escuro);
        height: 100vh;
        padding: var(--padding-grande);
        width: 20vw;
    }

    .item-de-menu {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    a {
        color: white;
        font-family: var(--fonte);
        font-size: var(--tamanho-da-fonte);
        margin: var(--margin-pequena);
        padding: var(--padding-texto);
        text-align: center;
        text-decoration: none;
        width: 100%;
    }

    .item-de-menu:hover {
        background-color: var(--amarelo-escuro);
    }

    .item-de-menu:active {
        background-color: var(--amarelo-pouco-escuro);
    }

    .form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        width: 80vw;
    }

    .campo-de-digitacao {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        margin: var(--margin-pequena);
    }

    label {
        font-family: var(--fonte);
        font-size: var(--tamanho-da-fonte);
        margin: var(--margin-pequena);
        padding: var(--padding-pequena);
        text-align: right;
        width: 128px;
    }

    input {
        background-color: white;
        font-family: var(--fonte);
        font-size: var(--tamanho-da-fonte);
        margin: var(--margin-pequena);
        padding: var(--padding-pequena);
        width: 256px;
    }

    button {
        background-color: var(--amarelo-muito-escuro);
        border: none;
        color: white;
        font-family: var(--fonte);
        font-size: var(--tamanho-da-fonte);
        margin: var(--margin-pequena);
        padding: var(--padding-texto);
    }

    button:hover {
        background-color: var(--amarelo-escuro);
    }

    button:active {
        background-color: var(--amarelo-pouco-escuro);
    }

    .buttons {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        margin: var(--margin-pequena);
        padding: var(--margin-pequena);
    }

    .erro {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        background-color: var(--cor-erro);
        margin: var(--margin-pequena);
        padding: var(--margin-pequena);
    }

    .sucesso {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        background-color: var(--cor-sucesso);
        margin: var(--margin-pequena);
        padding: var(--margin-pequena);
    }

    .mensagem {
        color: white;
        font-family: var(--fonte);
        font-size: var(--tamanho-da-fonte);
        margin: var(--margin-pequena);
        padding: var(--padding-pequena);
        text-align: center;
        width: 512px;
    }

    .lista {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 80vw;
    }

    table {
        margin: var(--margin-pequena);
        padding: var(--margin-pequena);
    }

    thead tr td {
        background-color: var(--amarelo-claro);
        font-weight: bold;
        padding: var(--padding-texto);
        text-align: center;
        text-transform: uppercase;
    }

    tbody tr {
        background-color: white;
    }

    tbody tr:hover {
        background-color: var(--amarelo-muito-claro);
    }

    tbody tr td {
        padding: var(--padding-texto);
        text-align: center;
    }

    select {
        background-color: white;
        font-family: var(--fonte);
        font-size: var(--tamanho-da-fonte);
        margin: var(--margin-pequena);
        padding: var(--padding-pequena);
        width: 271px;
    }

    select:hover {
        background-color: var(--amarelo-muito-claro);
    }
</style>