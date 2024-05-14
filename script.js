const password = document.getElementById('senha');
const icon = document.getElementById('icon');
function showHide(){
    if(password.type === 'password'){
        password.setAttribute('type','text');
        icon.classList.add('hide')
    }
    else{
        password.setAttribute('type', 'password');
        icon.classList.remove('hide')
    }
}