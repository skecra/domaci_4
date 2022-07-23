new TomSelect("#proizvodjac",{
    create: false,
    sortField: {
        field: "text",
        direction: "asc"
    }
  });

  let dugme = document.getElementById('forma')
  dugme.addEventListener("submit", function(e){
    let greske = 0
    e.preventDefault();
    let model = document.getElementById('model')
    let proizvodjac = document.getElementById('proizvodjac')
    
        if(model.value==''){
        document.getElementById('alert_model').classList.remove('d-none')
        model.classList.add('crveno')
        model.classList.remove('zeleno')
        greske++
        } else {
          document.getElementById('alert_model').classList.add('d-none')
          model.classList.add('zeleno')
          model.classList.remove('crveno')
        }

        if(proizvodjac.value==''){
            document.getElementById('alert_proizvodjac').classList.remove('d-none')
            proizvodjac.classList.add('crveno')
            proizvodjac.classList.remove('zeleno')
            greske++
            } else {
              document.getElementById('alert_proizvodjac').classList.add('d-none')
              proizvodjac.classList.add('zeleno')
              proizvodjac.classList.remove('crveno')
            }

            if(greske==0){
                document.getElementById('forma').submit()
            }

    })


    function clearInput(){
        document.querySelectorAll('input').forEach(input => {
          input.value=""
          input.classList.remove('zeleno')
          input.classList.remove('crveno')
        });
      
        document.querySelectorAll('.alert').forEach(alert => {
          alert.classList.add('d-none')
        });
      
      
        document.querySelectorAll('select').forEach(select=>{
            select.value = ""
            select.classList.remove('zeleno')
            select.classList.remove('crveno')
        })
      }
      