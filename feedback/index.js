document.addEventListener('DOMContentLoaded', function () {
const form = document.getElementById('form');
form.addEventListener('submit', formSend);

async function formSend(e) {
    e.preventDefault();

    let error = formValidate(form);

    let formData = new FormData(form);

    if (error === 0) {
         form.classList.add('_sending');

         let response = await fetch('sendmail.php', {
             method: 'POST',
             body: formData
         });
         if (response.ok) {
           let result  = await response.json();
           alert(result.message);
           form.reset();
           form.classList.remove('_sending');
         } else {
           alert('Ошибка');
           form.classList.remove('_sending');
         }
     } else {
        alert('Заполните обязательные поля');
     }
}

function formValidate(form) {
    let error = 0;
    const formReq = document.querySelector('._req');
    formRemoveError(formReq);

    if (formReq.value === '') {
        formAddError(formReq);
        error++;
    }
}

function formAddError(formReq) {
    formReq.parentElement.classList.add('_error');
    formReq.classList.add('_error');
}
function formRemoveError(formReq) {
    formReq.parentElement.classList.remove('_error');
    formReq.classList.remove('_error');
}
});
