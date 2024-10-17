-- Insert Users
INSERT INTO "User" (email, password, role, nama) VALUES
('jobseeker1@example.com', 'password123', 'jobseeker', 'John Doe'),
('jobseeker2@example.com', 'password123', 'jobseeker', 'Jane Smith'),
('company1@example.com', 'password123', 'company', 'Tech Innovations'),
('company2@example.com', 'password123', 'company', 'Creative Solutions');

-- Insert Company Details
INSERT INTO "Company_Detail" (user_id, lokasi, about) VALUES
(3, 'New York, USA', 'A leading technology company specializing in innovative solutions.'),
(4, 'San Francisco, USA', 'A creative agency focused on branding and design.');

-- Insert Job Openings
INSERT INTO "Lowongan" (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi) VALUES
(3, 'Software Engineer', 'Responsible for developing and maintaining applications.', 'full time', 'on-site'),
(3, 'UX Designer', 'Designing user-friendly interfaces for applications.', 'part time', 'remote'),
(4, 'Graphic Designer', 'Creating visual concepts and designs for clients.', 'internship', 'hybrid');

-- path masih belum tahu mau gimana, ini seeding dari ch4t9pt
-- Insert Attachments for Job Openings
INSERT INTO "Attachment_Lowongan" (lowongan_id, file_path) VALUES
(1, '/uploads/attachments/Software_Engineer_Job_Description.pdf'),
(2, '/uploads/attachments/UX_Designer_Job_Description.pdf'),
(3, '/uploads/attachments/Graphic_Designer_Job_Description.pdf');

-- Insert Applications
INSERT INTO "Lamaran" (user_id, lowongan_id, cv_path, video_path) VALUES
(1, 1, '/uploads/cv/John_Doe_CV.pdf', '/uploads/videos/John_Doe_Intro.mp4'),
(2, 2, '/uploads/cv/Jane_Smith_CV.pdf', NULL),
(1, 3, '/uploads/cv/John_Doe_CV.pdf', '/uploads/videos/John_Doe_Intro.mp4');