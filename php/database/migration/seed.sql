-- Insert Users
INSERT INTO "User" (email, password, role, nama) VALUES
-- $2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6 itu hasil hash dari 'password123'
('jobseeker1@example.com', '$2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6', 'jobseeker', 'Jane Doe'), -- no way zzz reference
('jobseeker2@example.com', '$2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6', 'jobseeker', 'John Smith'),
('company1@example.com', '$2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6', 'company', 'Tech Innovations'),
('company2@example.com', '$2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6', 'company', 'Creative Solutions');

-- Insert Company Details
INSERT INTO "Company_Detail" (user_id, lokasi, about) VALUES
(3, 'New York, USA', 'A leading technology company specializing in innovative solutions.'),
(4, 'San Francisco, USA', 'A creative agency focused on branding and design.');

-- Insert Job Openings
INSERT INTO "Lowongan" (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi) VALUES
(3, 'Software Engineer', 'Responsible for developing and maintaining applications.', 'full time', 'on-site'),
(3, 'UX Designer', 'Designing user-friendly interfaces for applications.', 'part time', 'remote'),
(4, 'Graphic Designer', 'Creating visual concepts and designs for clients.', 'internship', 'hybrid');

-- Insert Attachments Lowongan dan Lamaran pakai seed.php