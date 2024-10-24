<h1 align="center" style="color: #FFFFFF"><em> Tugas Besar IF3110 - Pengembangan Aplikasi Berbasis Web </em></h1>

<br>
<h1 align="center" style="color: #FFFFFF"> Kelompok 06 </h1>

<div align="center">

| NIM        | Nama           |
| ---------------- | ----------------- |
| 13522064 | Devinzen |
| 13522074 | Muhammad Naufal Aulia |
| 13522084 | Dhafin Fawwaz Ikramullah |

</div>

## 📒 Table of Contents
* [Description](#📄-description)
* [Requirements](#❓-requirements)
* [Installation](#🔨-installation)
* [Server](#🔨-run-the-server)
* [Screenshots](#📷-screenshots)
* [Member's Jobdesc](#📄-members-job-description)
* [Completed Bonus](#✨-completed-bonus)

## 📄 Description
This is a web-based application that can be used for job search and recruitment. Users can register as a jobseeker to apply for jobs, or as a company to open job vacancies.
## ❓ Requirements
Before using this application, make sure you have Docker installed on your computer.
## 🔨 Installation
To install this application, simply clone this repository:
```bash
git clone https://github.com/Labpro-21/if3110-tubes-2024-k02-06
```
Navigating to the project directory:
```bash
cd ./if3110-tubes-2024-k02-06
```
## 🔨 Run the Server
Make sure Docker is installed and running on your machine. Then, run the following command to start the server:

```bash
docker-compose up
```

If you want to seed the database, you can run this command in the php image inside the docker container:
```bash
php scripts/seed.php
```
You can also navigate to the project directory and run the seed.bat file (for Windows)
```bash
./seed.bat
```
Or by running this command:
```bash
docker exec -it <CONTAINERNAME> sh -c "php scripts/seed.php"
```


Now, you can access the server at `http://localhost:8080`.

## 📷 Screenshots
### Login Page:
<img src="screenshots/login.png" alt="Login" width="80%"/> <img src="screenshots/login_m.png" alt="Login mobile" width="17.5%"/>

### Register Page:
<img src="screenshots/register.png" alt="register" width="80%"/> <img src="screenshots/register_m.png" alt="register mobile" width="17.5%"/>

### Guest Job Page:
<img src="screenshots/guest_job.png" alt="guest_job" width="80%"/> <img src="screenshots/guest_job_m.png" alt="guest_job mobile" width="17.5%"/>

### Home (Job Seeker) Page:
<img src="screenshots/home_job.png" alt="home_job" width="80%"/> <img src="screenshots/home_job_m.png" alt="home_job mobile" width="17.5%"/>

### Detail lowongan (Job Seeker) Page:
<img src="screenshots/lowongan_app.png" alt="lowongan_app" width="80%"/> <img src="screenshots/lowongan_app_m.png" alt="lowongan_app mobile" width="17.5%"/>
<img src="screenshots/lowongan.png" alt="lowongan" width="80%"/> <img src="screenshots/lowongan_m.png" alt="lowongan mobile" width="17.5%"/>

### Lamaran Page:
<img src="screenshots/lamaran.png" alt="lamaran" width="80%"/> <img src="screenshots/lamaran_m.png" alt="lamaran mobile" width="17.5%"/>

### Detail Lamaran (Job Seeker) Page:
<img src="screenshots/detail_lamar.png" alt="detail_lamar" width="80%"/> <img src="screenshots/detail_lamar_m.png" alt="detail_lamar mobile" width="17.5%"/>

### Riwayat Lamaran Page:
<img src="screenshots/riwayat.png" alt="riwayat" width="80%"/> <img src="screenshots/riwayat_m.png" alt="riwayat mobile" width="17.5%"/>

### Home (Company) Page:
<img src="screenshots/home_comp.png" alt="home_comp" width="80%"/> <img src="screenshots/home_comp_m.png" alt="home_comp mobile" width="17.5%"/>

### Tambah Lowongan Page:
<img src="screenshots/add.png" alt="add" width="80%"/> <img src="screenshots/add_m.png" alt="add mobile" width="17.5%"/>

### Detail Lowongan (Company) & Export CSV Page:
<img src="screenshots/lowongan_comp.png" alt="lowongan_comp" width="80%"/> <img src="screenshots/lowongan_comp_m.png" alt="lowongan_comp mobile" width="17.5%"/>

### Edit Lowongan Page:
<img src="screenshots/edit_low.png" alt="edit_low" width="80%"/> <img src="screenshots/edit_low_m.png" alt="edit_low mobile" width="17.5%"/>

### Detail Lamaran (Company) Page:
<img src="screenshots/detail_lamar_comp.png" alt="detail_lamar_comp" width="80%"/> <img src="screenshots/detail_lamar_comp_m.png" alt="detail_lamar_comp mobile" width="17.5%"/>

### Profile Page:
<img src="screenshots/profil.png" alt="profil" width="80%"/> <img src="screenshots/profil_m.png" alt="profil mobile" width="17.5%"/>
<img src="screenshots/profil_edit.png" alt="profil_edit" width="80%"/> <img src="screenshots/profil_edit_m.png" alt="profil_edit mobile" width="17.5%"/>

### Not Found Page:
<img src="screenshots/not_found.png" alt="not_found" width="80%"/> <img src="screenshots/not_found_m.png" alt="not_found mobile" width="17.5%"/>


## 📄 Member's Job Description
### Server-side
| Fitur                    | NIM      |
| ------------------------ | -------- |
| Login                    |13522000|
| Register                 |          |
|                          |          |
|                          |          |
|                          |          |
|                          |          |
|                          |          |
|                          |          |
|                          |          |
|                          |          |


### Client-side
| Fitur                    | NIM      |
| ------------------------ | -------- |
| Login                    |          |
| Register                 |          |
|                          |          |
|                          |          |
|                          |          |
|                          |          |
|                          |          |
|                          |          |


## ✨ Completed Bonus
1. All Responsive Web Design
2. UI/UX seperti LinkedIn
3. Data Export
4. Google Lighthouse:
![lighthouse1](screenshots\1.png)
![lighthouse1](screenshots\2.png)
![lighthouse1](screenshots\3.png)
![lighthouse1](screenshots\4.png)
![lighthouse1](screenshots\5.png)
![lighthouse1](screenshots\6.png)
![lighthouse1](screenshots\7.png)
![lighthouse1](screenshots\8.png)
![lighthouse1](screenshots\9.png)