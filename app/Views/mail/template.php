<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Template Email Contato</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div>
        <div style="font-size: 26px;color: #41637e;font-family: sans-serif;margin-bottom: 20px;" id="emb-email-header">
           <p>Você tem uma nova mensagem do site, segue os dados abaixo:</p>
        </div>
        <p style="Margin-top: 0;color: #565656;font-family: Arial,serif;font-size: 14px;line-height: 5px;margin-bottom: 5px">
            <b>Nome: </b> <?php echo $name;?>
        </p> <br>    
        <p style="Margin-top: 0;color: #565656;font-family: Arial,serif;font-size: 14px;line-height: 5px;margin-bottom: 5px">
            <b>Email: </b> <?php echo $email;?>
        </p> <br>    
        <p style="Margin-top: 0;color: #565656;font-family: Arial,serif;font-size: 14px;line-height: 5px;margin-bottom: 5px">
            <b>Telefone: </b> <?php echo $phone;?>
        </p> <br>
        <p style="Margin-top: 0;color: #565656;font-family: Arial,serif;font-size: 14px;line-height: 5px;margin-bottom: 5px">
            <b>CNPJ: </b> <?php echo $cnpj;?>
        </p> <br>
        <p style="Margin-top: 0;color: #565656;font-family: Arial,serif;font-size: 14px;line-height: 5px;margin-bottom: 5px">
            <b>Mensagem</b> <br> 
            <?php echo $message;?>
        </p>
</body>

</html>