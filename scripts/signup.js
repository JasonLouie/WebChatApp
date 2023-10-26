const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input");
errorText = form.querySelector(".message");

form.onsubmit = (e)=>{
    e.preventDefault(); // Prevent form from submitting
}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); // Create XML object
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                errorText.innerHTML = "";
                if(data == "success"){
                    location.href = "users.php";
                }
                else{
                    const errors = data.split("|");
                    for (let i = 0; i < errors.length; i++){
                        if (errors[i].length > 0){
                            var p = document.createElement("p");
                            p.innerHTML = errors[i];
                            errorText.appendChild(p);
                        }
                    }
                }
            }
        }
    }
    // Send form data with ajax to php
    let formData = new FormData(form); // Create new formData object
    xhr.send(formData); // Send form data to php
}