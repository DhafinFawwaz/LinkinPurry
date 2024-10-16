

CREATE OR REPLACE PROCEDURE create_user_company(
    email VARCHAR(255),
    password VARCHAR(255),
    nama VARCHAR(255),
    lokasi VARCHAR(255),
    about TEXT
) AS $$
DECLARE
    inserted_user_id INT;
BEGIN
    INSERT INTO "User" (email, password, role, nama) VALUES (email, password, 'company', nama) RETURNING user_id INTO inserted_user_id;
    INSERT INTO "Company_Detail" (user_id, lokasi, about) VALUES (inserted_user_id, lokasi, about);
END;
$$ LANGUAGE plpgsql;
