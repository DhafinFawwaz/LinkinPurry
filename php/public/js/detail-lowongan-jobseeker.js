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
applicationForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Mencegah submit form secara default

    // Simulasi pengiriman data
    const formData = new FormData(applicationForm);
    const cvUpload = document.getElementById('cv');
    const errorMessages = document.getElementById("error-message");
    // const cv = formData.get('cv');  
    // const video = formData.get('video');

    // clear error message
    errorMessages.style.display = "none";

    // cek uploaded file
    if (!cvUpload.files.length) {
        errorMessages.style.display = "block";
        errorMessages.textContent = "A resume is required";
        return;
    }

    // // Update status pelamar menjadi true setelah submit
    // job_seeker_applied = true;

    // // Tutup modal setelah submit
    // modal.style.display = "none";

    // // Reset form
    // resetForm();

    // Tampilkan section aplikasi lamaran setelah submit
    // const applicationStatusSection = document.getElementById('application-status');
    // applicationStatusSection.style.display = "block";  // Menampilkan bagian status lamaran

    // // Simulasi menampilkan data lamaran yang disubmit (update halaman secara dinamis)
    // document.querySelector("#application-status ul").innerHTML = `
    //     <li>Status: waiting</li>
    //     <li>Attachments:
    //         <a href="${URL.createObjectURL(cv)}" target="_blank" class="button-attachment">CV</a>
    //         ${video ? `<a href="${URL.createObjectURL(video)}" target="_blank" class="button-attachment">Video</a>` : ''}
    //     </li>   
    //     <li>Next Step: your application is being reviewed by our team.</li>
    // `;

    // alert("Application submitted successfully!");

    console.log("Form submitted");  
});