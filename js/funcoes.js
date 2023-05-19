function checkMail(mail)
{
    var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
    if(typeof(mail) == "string"){
        if(er.test(mail)){ return true; }
    }else if(typeof(mail) == "object"){
        if(er.test(mail.value)){
                    return true;
                }
    }else{
        return false;
        }
}

function validaLogin()
{

    if(document.getElementById("usuario").value == ""  )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("usuario").focus();
        return false;
    }
    if(!checkMail(document.getElementById("usuario").value))
    {
        alert("Favor preencher com um endereço de email válido");
        document.getElementById("usuario").value = "";
        document.getElementById("usuario").focus();
        return false;
    }
    if(document.getElementById("senha").value == "")
    {
        alert("Favor preencher todos os campos");
        document.getElementById("senha").focus();
        return false;
    }
    return true;
}

function validaContato()
{
    if(document.getElementById("nome").value == "")
    {
        alert("Favor preencher todos os campos");
        document.getElementById("nome").focus();
        return false;
    }
    if(document.getElementById("email").value == ""  )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("email").focus();
        return false;
    }
    if(!checkMail(document.getElementById("email").value))
    {
        alert("Favor preencher com um endereço de email válido");
        document.getElementById("email").value = "";
        document.getElementById("email").focus();
        return false;
    }
    if(document.getElementById("fone").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("fone").focus();
        return false;
    }
    if(document.getElementById("assunto").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("assunto").focus();
        return false;
    }
    if(document.getElementById("mensagem").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("mensagem").focus();
        return false;
    }


    return true;
}

function validaSolicitacao()
{
    if(document.getElementById("nome").value == "")
    {
        alert("Favor preencher todos os campos");
        document.getElementById("nome").focus();
        return false;
    }
    if(document.getElementById("email").value == ""  )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("email").focus();
        return false;
    }
    if(!checkMail(document.getElementById("email").value))
    {
        alert("Favor preencher com um endereço de email válido");
        document.getElementById("email").value = "";
        document.getElementById("email").focus();
        return false;
    }
    
    if(document.getElementById("cep").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("cep").focus();
        return false;
    }

    
    if(document.getElementById("endereco1").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("endereco1").focus();
        return false;
    }
    
    if(document.getElementById("nr_endereco").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("nr_endereco").focus();
        return false;
    }
    
    if(document.getElementById("bairro").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("bairro").focus();
        return false;
    }
    
    
    
    if(document.getElementById("cidade").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("cidade").focus();
        return false;
    }
    if(document.getElementById("estado").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("estado").focus();
        return false;
    }
    
    if(document.getElementById("fone").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("fone").focus();
        return false;
    }


    return true;
}
