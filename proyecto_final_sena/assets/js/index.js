window.addEventListener('DOMContentLoaded',()=>{
    // Const
    const nameInput = document.querySelector('#nombre');
    const emailInput = document.querySelector('#email');
    const ccInput = document.querySelector('#cc');
    const commentText = document.querySelector('#apellido');
    const sendButton = document.querySelector('.disableButton');
    const blurDiv = document.querySelector('.blurBody');
    const divLoader = document.querySelector('.divLoader');
    const adminButton = document.querySelector('.admin');
    const regEx = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    const validationObject = {
        email: "",
        name: "",
        cc: "",
    };
    // -----
    // Variables
    let validation;
    let inputValue = () =>{
        if(nameInput.value != '' && emailInput.value != '' && ccInput.value != '' && regEx.test(emailInput.value) && regEx.test(ccInput.value)){
            sendButton.classList.remove('disableButton');
            sendButton.removeAttribute('disabled');
            validationObject.name = nameInput.value;
            validationObject.email = emailInput.value;
            validationObject.cc = ccInput.value;
        }
    };
    let validateInput = inputName =>{
        inputName.addEventListener('input',e => {
            if(e.target.value == ''){
                e.target.placeholder = `El ${e.target.id} es requerido`;
                inputName.classList.add('required');
            }
            if (regEx.test(e.target.value)) {
                if(e.target.parentElement.querySelector(".wrongValue")){
                    e.target.parentElement.querySelector(".wrongValue").remove();
                }
            } else {
                if(!e.target.parentElement.querySelector(".wrongValue") && e.target.type == "email"){
                    const divElement = document.createElement("div");
                    divElement.classList.add('wrongValue');
                    divElement.textContent = "Ingresa un email valido, por favor";
                    e.target.parentElement.appendChild(divElement);
                    return;
                } 
            }
            inputValue();
            let arrayOfValues = Object.values(validationObject);
            validation = arrayOfValues.some(element=>{element == ''})
          })
          commentText.addEventListener('input',e => {
            if(e.target.value == ''){
                e.target.placeholder = `El ${e.target.id} es requerido`;
                commentText.classList.add('required');
            }
          })
    };
    // -----
    // Events
    sendButton.addEventListener('click',(e)=>{
        e.preventDefault();
        if(validation == false){
            blurDiv.style.filter = "blur(5px)";
            divLoader.style.display = "flex";
            setTimeout(()=> {
                blurDiv.style.filter = "blur(0px)";
                divLoader.style.display = "none";
                nameInput.value = "";
                emailInput.value = "";
                ccInput.value = "";
                commentText.value = "";
                sendButton.classList.add('disableButton');
                sendButton.setAttribute('disabled','true');
                setTimeout(()=>{
                    window.location.href = "logged.html";
                })
            },3000)
        }
    });
    adminButton.addEventListener('click',()=>{
         window.location.href = "data.html";
    });
    // -----
    // Fuctions
   
    // -----
    // Call Fuctions
    validateInput(nameInput);
    validateInput(emailInput);
    validateInput(ccInput);
    // -----
})