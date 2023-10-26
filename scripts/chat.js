const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button");
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault(); // Prevent form from submitting
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest(); // Create XML object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; // Empty input field after sending message
                scrollToBottom();
            }
        }
    }
    // Send form data with ajax to php
    let formData = new FormData(form); // Create new formData object
    xhr.send(formData); // Send form data to php
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    let xhr = new XMLHttpRequest(); // Create XML object
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ // If chatbox is not active, scroll to bottom
                    scrollToBottom();
                }
            }
        }
    }
    // Send form data with ajax to php
    let formData = new FormData(form); // Create new formData object
    xhr.send(formData); // Send form data to php
}, 500); // Function runs every 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}