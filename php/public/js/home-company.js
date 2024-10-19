// ngirim request AJAX ke /home-company
function filterAndSortJobs(page = 1) {
    const searchQuery = document.getElementById('search-input').value;
    const jobType = document.getElementById('job-type-filter').value;
    const locationType = document.getElementById('location-type-filter').value;
    const sortByDate = document.getElementById('sort-by-date').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/home-company', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status === 200) {
            const jobList = document.querySelector('.job-list');
            jobList.innerHTML = xhr.responseText;
        }
    };

    xhr.send(`search=${encodeURIComponent(searchQuery)}&jobType=${encodeURIComponent(jobType)}&locationType=${encodeURIComponent(locationType)}&sortByDate=${encodeURIComponent(sortByDate)}&page=${encodeURIComponent(page)}`);
}

let debounceTimer;
function debouncedSearch() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(filterAndSortJobs, 300);
}
