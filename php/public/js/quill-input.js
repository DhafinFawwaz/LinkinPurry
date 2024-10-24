(() => {

const options = {
  placeholder: 'Waiting for your precious content',
  theme: 'snow'
};

const quill = new Quill('#quillEditor', options);

const textarea = document.querySelector('#hiddenArea');
const form = document.querySelector("form");
form.addEventListener("submit", (e) => {
  // will still trigger basic form submission and textarea value in formdata will be updated, see network inspect after submit
  textarea.value = quill.root.innerHTML;
})

})();
