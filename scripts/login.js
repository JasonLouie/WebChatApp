const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-login");

form.onsubmit = (e)=>{
    e.preventDefault(); // Prevent form from submitting
}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); // Create XML object
    xhr.open("POST", "php/handle-login.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                errorText.innerHTML = "";
                if(data == "success"){
                    location.href = "users.php";
                }
                else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        }
    }
    // Send form data with ajax to php
    let formData = new FormData(form); // Create new formData object
    xhr.send(formData); // Send form data to php
}