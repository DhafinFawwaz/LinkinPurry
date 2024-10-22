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
applicationForm.addEventListener("submit", function(event) {
    var resumeInput = document.getElementById("cv");
    var resumeErrorMessage = document.getElementById("error-message");

    resumeErrorMessage.textContent = "";

    if (resumeInput.files.length === 0) {
        // tahan submission
        event.preventDefault();

        errorMessages.style.display = "block";
        resumeErrorMessage.textContent = "A resume is required";
    }
});
