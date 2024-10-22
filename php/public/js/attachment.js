const attachmentContainer = document.getElementById("attachment-container");
const attachmentInput = document.getElementById("attachment-input");


attachmentInput.addEventListener("change", () => {
    const files = attachmentInput.files;
    if(files.length == 0) return;
    attachmentContainer.innerHTML = "";
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement("img");
            const div = document.createElement("div");
            div.appendChild(img);
            img.src = e.target.result;
            attachmentContainer.appendChild(div);
        }
        reader.readAsDataURL(files[i]);
    }
});