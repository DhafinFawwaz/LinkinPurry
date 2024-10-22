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
* [Deskripsi](#📄-deskripsi)
* [Requirements](#❓-requirements)
* [Instalasi](#🔨-instalasi)
* [Server](#🔨-menjalankan-server)
* [Pembagian](#📄-pembagian-tugas)

## 📄 Deskripsi
This is a web-based application that can be used for job search and recruitment. Users can register as a jobseeker to apply for jobs, or as a company to open job vacancies.
## ❓ Requirements
Before using this application, make sure you have Docker installed on your computer.
## 🔨 Instalasi
To install this application, simply clone this repository:
```bash
git clone https://github.com/Labpro-21/if3110-tubes-2024-k02-06
```
Navigating to the project directory:
```bash
cd ./if3110-tubes-2024-k02-06
```
## 🔨 Menjalankan Server
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

## 📄 Screenshots

## 📄 Pembagian Tugas
Server-side

Client-side
