CREATE TYPE role_type AS ENUM('jobseeker', 'company');

-- Tabel User
CREATE TABLE "User" (
    user_id SERIAL PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role role_type NOT NULL,
    nama VARCHAR(255) NOT NULL
);

-- Tabel Company Detail
CREATE TABLE "Company_Detail" (
    user_id INT PRIMARY KEY REFERENCES "User" (user_id) ON DELETE CASCADE,
    lokasi VARCHAR(255),
    about TEXT
);

-- Tabel Lowongan

CREATE TYPE job_type AS ENUM('Full Time', 'Part Time', 'Internship');
CREATE TYPE location_type AS ENUM('On-Site', 'Hybrid', 'Remote');

CREATE TABLE "Lowongan" (
    lowongan_id SERIAL PRIMARY KEY,
    company_id INT REFERENCES "User" (user_id) ON DELETE CASCADE,
    posisi VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    jenis_pekerjaan job_type NOT NULL,
    jenis_lokasi location_type NOT NULL,
    is_open BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Attachment Lowongan
CREATE TABLE "Attachment_Lowongan" (
    attachment_id SERIAL PRIMARY KEY,
    lowongan_id INT REFERENCES "Lowongan" (lowongan_id) ON DELETE CASCADE,
    file_path VARCHAR(255) NOT NULL
);

-- Tabel Lamaran
CREATE TABLE "Lamaran" (
    lamaran_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES "User" (user_id) ON DELETE CASCADE,
    lowongan_id INT REFERENCES "Lowongan" (lowongan_id) ON DELETE CASCADE,
    cv_path VARCHAR(255) NOT NULL,
    video_path VARCHAR(255),
    status VARCHAR(20) CHECK (status IN ('accepted', 'rejected', 'waiting')) DEFAULT 'waiting',
    status_reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
