var modal = document.getElementById("applyModal");
var btn = document.getElementById("applyBtn");
var span = document.getElementById("closeModal");

const applicationForm = document.getElementById("applicationForm");
const resumeFileName = document.getElementById("resumeFileName");
const videoFileName = document.getElementById("videoFileName");
const closeModal = document.getElementById("closeModal");
const errorMessages = document.getElementById("error-message");

// reset saat close
function resetForm() {
    applicationForm.reset();
    resumeFileName.textContent = "No file chosen";
    videoFileName.textContent = "No file chosen";
}

// tampilkan popup
btn.onclick = function() {
    modal.style.display = "block";
    // clear error message
    errorMessages.style.display = "none";
}

// tutup popup
closeModal.onclick = function() {
    modal.style.display = "none";
    console.log("anu");
    resetForm();
}

// tutup popup saat klik daerah luar
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        resetForm();
    }
}

// update nama uploaded file
function updateFileName(inputId, labelId) {
    var input = document.getElementById(inputId);
    var label = document.getElementById(labelId);
    var fileName = input.files.length > 0 ? input.files[0].name : "No file chosen";
    label.textContent = fileName;
}

// error message


// handle submit
// applicationForm.addEventListener("submit", function(event) {
//     event.preventDefault(); // Mencegah submit form secara default

//     // Simulasi pengiriman data
//     const formData = new FormData(applicationForm);
//     const cvUpload = document.getElementById('cv');
//     const errorMessages = document.getElementById("error-message");
//     // const cv = formData.get('cv');  
//     // const video = formData.get('video');

//     // clear error message
//     errorMessages.style.display = "none";

//     // cek uploaded file
//     if (!cvUpload.files.length) {
//         errorMessages.style.display = "block";
//         errorMessages.textContent = "A resume is required";
//         return;
//     }

//     console.log("Form submitted");  
// });