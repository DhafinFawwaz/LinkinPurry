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

CREATE OR REPLACE PROCEDURE update_user_company(
    user_id_to_update INT,
    new_nama VARCHAR(255),
    new_lokasi VARCHAR(255),
    new_about TEXT
) AS $$
BEGIN
    UPDATE "User" SET nama = new_nama WHERE user_id = user_id_to_update;
    UPDATE "Company_Detail" SET lokasi = new_lokasi, about = new_about WHERE user_id = user_id_to_update;
END;
$$ LANGUAGE plpgsql;

/* function dan trigger untuk update updated_now pada "Lowongan" saat diupdate */
CREATE OR REPLACE FUNCTION update_updated_at_lowongan_kerja_function()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER update_updated_at_lowongan_kerja
BEFORE UPDATE ON "Lowongan"
FOR EACH ROW
EXECUTE FUNCTION update_updated_at_lowongan_kerja_function();