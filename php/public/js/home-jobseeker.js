// ngirim request AJAX ke /home-jobseeker
function filterAndSortJobs(page = 1) {
    const searchQuery = document.getElementById('search-input').value;
    
    const jobTypeCheckboxes = document.querySelectorAll('.job-type-checkbox:checked');
    const locationTypeCheckboxes = document.querySelectorAll('.location-type-checkbox:checked');
    
    // array untuk simpan nilai dari checkbox
    let jobTypes = Array.from(jobTypeCheckboxes).map(cb => cb.value);
    let locationTypes = Array.from(locationTypeCheckboxes).map(cb => cb.value);
    
    const sortByDate = document.getElementById('sort-by-date').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status === 200) {
            const jobList = document.querySelector('.job-list');
            jobList.innerHTML = xhr.responseText;
        }
    };

    xhr.send(`search=${encodeURIComponent(searchQuery)}&jobTypes=${encodeURIComponent(jobTypes.join(','))}&locationTypes=${encodeURIComponent(locationTypes.join(','))}&sortByDate=${encodeURIComponent(sortByDate)}&page=${encodeURIComponent(page)}`);
}


let debounceTimer;
function debouncedSearch() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(filterAndSortJobs, 300);
}

filterAndSortJobs();