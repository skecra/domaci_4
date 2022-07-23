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
      let registracija = document.getElementById('registracija')
      let proizvodjac = document.getElementById('proizvodjac')
      let model = document.getElementById('modeli')
      let godina = document.getElementById('godina')
      let klasa = document.getElementById('klasa')
      let cijena = document.getElementById('cijena')
      let profilna = document.getElementById('profilna')
          if(registracija.value==''){
          document.getElementById('alert_registracija').classList.remove('d-none')
          registracija.classList.add('crveno')
          registracija.classList.remove('zeleno')
          greske++
          } else {
            document.getElementById('alert_registracija').classList.add('d-none')
            registracija.classList.add('zeleno')
            registracija.classList.remove('crveno')
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
              if(godina.value==''){
                document.getElementById('alert_godina').classList.remove('d-none')
                godina.classList.add('crveno')
                godina.classList.remove('zeleno')
                greske++
                } else {
                  document.getElementById('alert_godina').classList.add('d-none')
                  godina.classList.add('zeleno')
                  godina.classList.remove('crveno')
                }
                if(klasa.value==''){
                  document.getElementById('alert_klasa').classList.remove('d-none')
                  klasa.classList.add('crveno')
                  klasa.classList.remove('zeleno')
                  greske++
                  } else {
                    document.getElementById('alert_klasa').classList.add('d-none')
                    klasa.classList.add('zeleno')
                    klasa.classList.remove('crveno')
                  }
                  if(cijena.value==''){
                    document.getElementById('alert_cijena').classList.remove('d-none')
                    cijena.classList.add('crveno')
                    cijena.classList.remove('zeleno')
                    greske++
                    } else {
                      document.getElementById('alert_cijena').classList.add('d-none')
                      cijena.classList.add('zeleno')
                      cijena.classList.remove('crveno')
                    }

  
                      if(greske==0){
                        document.getElementById('forma').submit()
                      }
          
    })
  
  
  
  
    var baseUrl = "http://localhost/rentAcar/";
  
  async function displayModels( selectedModel){
      let proizvodjac_id = document.getElementById("proizvodjac").value;
      let response = await fetch(baseUrl+"vozila/getModelsByProizvodjac.php?proizvodjac_id="+proizvodjac_id);
      let modeli = await response.json();
      let selected = ""
    
      let modeliHTML = '';
      modeli.forEach( (model) => {
        if(selectedModel == model.ID){
          modeliHTML += `<option selected value="${model.ID}" >${model.model}</option>`;
            
        }else {
          modeliHTML += `<option value="${model.ID}" >${model.model}</option>`;

        }
      });
  
      document.getElementById("modeli").innerHTML = modeliHTML;
  }
  
  
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
  
  
  