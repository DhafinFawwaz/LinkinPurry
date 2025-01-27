let lastPage = 1; // Used in filterAndSortJobs and deleteJob
document.querySelectorAll('.collapsible-title').forEach(button => {
    button.addEventListener('click', function () {
        const idFilter = this.getAttribute('data-filter');
        const filter = document.getElementById(idFilter);
        const icon = this.querySelector('.title-icon');
        
        // if filter active, then close it
        if (filter.classList.contains('active') && icon.classList.contains('active')) {
            // filter.style.display = 'none';
            filter.classList.remove('active');
            icon.classList.remove('active');
        } else {
            // filter.style.display = 'block';
            filter.classList.add('active');
            icon.classList.add('active');
        }
    });
})

// ngirim request AJAX ke /home-jobseeker
function filterAndSortJobs(page = 1) {
    lastPage = page;
    const searchQuery = document.getElementById('search-input').value;
    
    const jobTypeCheckboxes = document.querySelectorAll('.job-type-checkbox:checked');
    const locationTypeCheckboxes = document.querySelectorAll('.location-type-checkbox:checked');
    const selectedSortByDate = document.querySelector('input[name="sort-by-date"]:checked');
    
    // array untuk simpan nilai dari checkbox
    let jobTypes = Array.from(jobTypeCheckboxes).map(cb => cb.value);
    let locationTypes = Array.from(locationTypeCheckboxes).map(cb => cb.value);
    let sortByDate = '';
    if (selectedSortByDate) {
        sortByDate = selectedSortByDate.value;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/api/search?search=${encodeURIComponent(searchQuery)}&jobTypes=${encodeURIComponent(jobTypes.join(','))}&locationTypes=${encodeURIComponent(locationTypes.join(','))}&sortByDate=${encodeURIComponent(sortByDate)}&page=${encodeURIComponent(page)}`, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.withCredentials = true;
    xhr.onload = function () {
        if (xhr.status === 200) {
            const jobList = document.querySelector('.job-list');
            jobList.innerHTML = xhr.responseText;
        }
    };

    xhr.send(null);
}


let debounceTimer;
function debouncedSearch() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(filterAndSortJobs, 300);
}

function deleteJob(jobId) {
    const page = lastPage;
    const searchQuery = document.getElementById('search-input').value;
    
    const jobTypeCheckboxes = document.querySelectorAll('.job-type-checkbox:checked');
    const locationTypeCheckboxes = document.querySelectorAll('.location-type-checkbox:checked');
    const selectedSortByDate = document.querySelector('input[name="sort-by-date"]:checked');
    
    // array untuk simpan nilai dari checkbox
    let jobTypes = Array.from(jobTypeCheckboxes).map(cb => cb.value);
    let locationTypes = Array.from(locationTypeCheckboxes).map(cb => cb.value);
    let sortByDate = '';
    if (selectedSortByDate) {
        sortByDate = selectedSortByDate.value;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', `/api/${jobId}/delete`, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.withCredentials = true;
    xhr.onload = function () {
        if (xhr.status === 200) {
            const jobList = document.querySelector('.job-list');
            jobList.innerHTML = xhr.responseText;
            try { startToast("Success", "Job deleted successfully", "success");} catch(e){}
        }
    };

    xhr.send(`search=${encodeURIComponent(searchQuery)}&jobTypes=${encodeURIComponent(jobTypes.join(','))}&locationTypes=${encodeURIComponent(locationTypes.join(','))}&sortByDate=${encodeURIComponent(sortByDate)}&page=${encodeURIComponent(page)}`);
}

filterAndSortJobs();

