const cancelProfileButton = document.getElementById("cancel-profile-button");
const usernameInput = document.getElementById("username");
const locationInput = document.getElementById("location");
const aboutInput = document.getElementById("about");

let currentUsername;
let currentLocation;
let currentAbout;

try{
    currentUsername = usernameInput.value;
    currentLocation = locationInput.value;
    currentAbout = aboutInput.value;
} catch (e) {}





const editPopUpSection = document.getElementsByClassName("edit-popup")[0];
const editButton = document.getElementsByClassName("edit-button")[0];
const closeButton = document.getElementsByClassName("close-button")[0];
const blackBg = document.getElementsByClassName("black-bg")[0];
editButton.addEventListener("click", () => {
    editPopUpSection.classList.remove("hide");
    editPopUpSection.classList.add("show");
});
function close() {
    editPopUpSection.classList.remove("show");
    editPopUpSection.classList.add("hide");
    usernameInput.value = currentUsername;
    if(locationInput) locationInput.value = currentLocation;
    if(aboutInput) aboutInput.value = currentAbout;
}
closeButton.addEventListener("click", close);
blackBg.addEventListener("click", close);
cancelProfileButton.addEventListener("click", close);


function updateProfile() {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', `/profile`, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.withCredentials = true;
    xhr.onload = function () {
        if (xhr.status === 200) {
            const profileContainer = document.getElementById('profile-container');
            profileContainer.innerHTML = xhr.responseText;

            editPopUpSection.classList.remove("show");
            editPopUpSection.classList.add("hide");

            updateButton.removeAttribute("disabled");
            cancelProfileButton.removeAttribute("disabled");

            currentUsername = usernameInput.value;
            if(locationInput) currentLocation = locationInput.value;
            if(aboutInput) currentAbout = aboutInput.value;
        }
    };

    const username = usernameInput.value;
    let body = `username=${encodeURIComponent(username)}`;
    if(locationInput) body += `&location=${encodeURIComponent(locationInput.value)}`;
    if(aboutInput) body += `&about=${encodeURIComponent(aboutInput.value)}`;

    xhr.send(body);
    updateButton.setAttribute("disabled", "disabled");
    cancelProfileButton.setAttribute("disabled", "disabled");
}

const updateButton = document.getElementById("update-button");
updateButton.addEventListener("click", updateProfile);