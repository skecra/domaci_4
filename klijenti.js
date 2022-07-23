let dugme = document.getElementById('forma')
  dugme.addEventListener("submit", function(e){
    let greske = 0
    e.preventDefault();
    let ime = document.getElementById('ime')
    let prezime = document.getElementById('prezime')
    let drzava = document.getElementById('drzava')
    let broj_pasosa = document.getElementById('pasos')

        if(ime.value==''){
        document.getElementById('alert_ime').classList.remove('d-none')
        ime.classList.add('crveno')
        ime.classList.remove('zeleno')
        greske++
        } else {
          document.getElementById('alert_ime').classList.add('d-none')
          ime.classList.add('zeleno')
          ime.classList.remove('crveno')
        }
        if(prezime.value==''){
          document.getElementById('alert_prezime').classList.remove('d-none')
          prezime.classList.add('crveno')
          prezime.classList.remove('zeleno')
          greske++
          } else {
            document.getElementById('alert_prezime').classList.add('d-none')
            prezime.classList.add('zeleno')
            prezime.classList.remove('crveno')
          }
          if(drzava.value==''){
            document.getElementById('alert_drzava').classList.remove('d-none')
            drzava.classList.add('crveno')
            drzava.classList.remove('zeleno')
            greske++
            } else {
              document.getElementById('alert_drzava').classList.add('d-none')
              drzava.classList.add('zeleno')
              drzava.classList.remove('crveno')
            }
            if(broj_pasosa.value==''){
              document.getElementById('alert_pasos').classList.remove('d-none')
              broj_pasosa.classList.add('crveno')
              broj_pasosa.classList.remove('zeleno')
              greske++
              } else {
                document.getElementById('alert_pasos').classList.add('d-none')
                broj_pasosa.classList.add('zeleno')
                broj_pasosa.classList.remove('crveno')
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

