(() => {
var modal = document.getElementById("applyModal");
var modalClass = document.getElementsByClassName("modal")[0];
var btn = document.getElementById("applyBtn");

const applicationForm = document.getElementById("applicationForm");
const resumeFileName = document.getElementById("resumeFileName");
const videoFileName = document.getElementById("videoFileName");
const closeModal = document.getElementById("closeModal");
const errorMessages = document.getElementById("error-message");

const uploadResumeBtn = document.getElementById('uploadResumeBtn');
const resumeInput = document.getElementById('cv');
const uploadVideoBtn = document.getElementById('uploadVideoBtn');
const videoInput = document.getElementById('video');

uploadResumeBtn.addEventListener('click', function() {
    resumeInput.click();
});

uploadVideoBtn.addEventListener('click', function() {
    videoInput.click();
});


// reset saat close
function resetForm() {
    applicationForm.reset();
    resumeFileName.textContent = "No file chosen";
    videoFileName.textContent = "No file chosen";
}

// tampilkan popup
btn.addEventListener("click", function() {
    modalClass.classList.remove("hide");
    modalClass.classList.add("show");
    errorMessages.style.display = "none";
});

// tutup popup
closeModal.addEventListener("click", function() {
    modalClass.classList.remove("show");
    modalClass.classList.add("hide");
    resetForm();
});

// tutup popup saat klik daerah luar
window.onclick = function(event) {
    if (event.target == modal) {
        modalClass.classList.remove("show");
        modalClass.classList.add("hide");
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

resumeInput.addEventListener('change', function() {
    updateFileName('cv', 'resumeFileName');
});

videoInput.addEventListener('change', function() {
    updateFileName('video', 'videoFileName');
});


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

})();
