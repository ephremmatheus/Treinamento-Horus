<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Insert</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <form enctype="multipart/form-data" action="/treinamento/nivel1/pessoa_save_insert.php" method="POST">
        <label for="idId">ID</label>
        <input type="text" name="id" id="idId" style="width: 30%"> <!-- precisei alterar "readonly"-->

        <label for="idNome">Nome</label>
        <input type="text" name="nome" id="idNome" style="width: 50%">

        <label for="idEndereco">Endereco</label>
        <input type="text" name="endereco" id="idEndereco" style="width: 50%">

        <label for="idBairro">Bairro</label>
        <input type="text" name="bairro" id="idBairro" style="width: 25%">

        <label for="idTelefone">Telefone</label>
        <input type="text" name="telefone" id="idTelefone" style="width: 25%">

        <label for="idEmail">Email</label>
        <input type="text" name="email" id="idEmail" style="width: 25%">

        <label for="idCidade">Cidade</label>
        <input type="text" name="cidade" id="idCidade" style="width: 25%">

        <input type="submit" value="Enviar">
    </form>
</body>
</html>