
const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    $(document).ready(function(){
        $('#larin').on('select2:select', function (e) {
            var prueba = e.params.data;
            Pclave = prueba.id
            fetch('/eventos/getLarin',{
                method : 'POST',
                body: JSON.stringify({
                    id_larin : Pclave
                    }),
                headers:{
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            }).then(response=>{
                return response.json()
            }).then( respuesta=>{
                document.getElementById('descripcion').value=respuesta[0].larin
                console.log(respuesta[0].larin);
            }).catch(error => console.error(error));
        });

    })


  