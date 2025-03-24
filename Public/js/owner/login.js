
const form=document.getElementById('formLogin');
const inputs=document.querySelectorAll('.form-control-user')
const message=document.getElementById('message');
form.addEventListener('submit', function(event){
    event.preventDefault();
    const formData=new FormData;
    
    inputs.forEach((input)=>{
        if(input.value.trim()===""){
            message.innerHTML=Msg("error", "Veuillez remplir tous les champs");
            return;
        }else{
            formData.append(input.name, input.value.trim())
        }
    });

    Poster(baseUrl+'/login/auth', (data)=>{
        message.innerHTML=Msg(data.type, data.message);
        if(data.type==="success"){
            setTimeout(() => {
                window.location.href=baseUrl+ '/index.php?p=dashboard';
            }, 2000);
        }else{
            return;
        }
        
    }, formData)
})

