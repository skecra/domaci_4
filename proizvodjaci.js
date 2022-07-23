let dugme = document.getElementById('forma')
  dugme.addEventListener("submit", function(e){
    let greske = 0
    e.preventDefault();
    let naziv = document.getElementById('naziv')
    

        if(naziv.value==''){
        document.getElementById('alert_naziv').classList.remove('d-none')
        naziv.classList.add('crveno')
        naziv.classList.remove('zeleno')
        greske++
        } else {
          document.getElementById('alert_naziv').classList.add('d-none')
          naziv.classList.add('zeleno')
          naziv.classList.remove('crveno')
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