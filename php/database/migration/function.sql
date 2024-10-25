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




-- 10 slots

-- get all riwayat lamaran
-- group by company and count them, sort by count
-- for each company, get all newest open job, and at most 6 months old, limit 6
-- limit the result by 6

-- get all open job that is posted at the same day (use updated_at)
-- sort by the amount of lamaran
-- limit 10
-- fill the remaining slots

-- if slot isnt full yet, get all newest job and fill it.

CREATE OR REPLACE FUNCTION getRecommendedLowongan(
    inserted_user_id INT
) RETURNS TABLE (
    lowongan_id INT,
    company_id INT,
    posisi VARCHAR(255),
    deskripsi TEXT,
    jenis_pekerjaan job_type,
    jenis_lokasi location_type,
    is_open BOOLEAN,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    company_name VARCHAR(255),
    lokasi VARCHAR(255)
) AS $$
DECLARE
    company RECORD;
BEGIN
    CREATE TEMP TABLE temp_recommendations (
        lowongan_id INT,
        company_id INT,
        posisi VARCHAR(255),
        deskripsi TEXT,
        jenis_pekerjaan job_type,
        jenis_lokasi location_type,
        is_open BOOLEAN,
        created_at TIMESTAMP,
        updated_at TIMESTAMP,
        company_name VARCHAR(255),
        lokasi VARCHAR(255)
    );

    -- top companies by number of applications that user has applied to
    CREATE TEMP TABLE temp_top_companies (
        company_id INT,
        total_applications INT,
        company_name VARCHAR(255),
        lokasi VARCHAR(255)
    );

    -- list of applied jobs
    CREATE TEMP TABLE temp_applied_jobs (
        lowongan_id INT
    );
    INSERT INTO temp_applied_jobs
    SELECT la.lowongan_id
    FROM "Lamaran" la
    WHERE la.user_id = inserted_user_id;

    INSERT INTO temp_top_companies
    SELECT l.company_id, COUNT(la.lamaran_id) as count, u.nama, cd.lokasi
    FROM "Lamaran" la
    JOIN "User" u ON u.user_id = la.user_id
    JOIN "Lowongan" l ON l.lowongan_id = la.lowongan_id
    JOIN "User" u2 ON u2.user_id = l.company_id
    JOIN "Company_Detail" cd ON cd.user_id = l.company_id
    WHERE la.user_id = inserted_user_id
        AND l.is_open = TRUE
        AND DATE(l.updated_at) >= CURRENT_DATE - INTERVAL '6 months'
    GROUP BY l.company_id, u.nama, cd.lokasi
    ORDER BY count DESC
    LIMIT 10;



    -- For each company, get 3 newest open jobs that user hasn't applied to
    FOR company IN
        SELECT * FROM temp_top_companies
    LOOP
        INSERT INTO temp_recommendations
        SELECT l.lowongan_id, l.company_id, l.posisi, l.deskripsi, l.jenis_pekerjaan,
               l.jenis_lokasi, l.is_open, l.created_at, l.updated_at, u.nama AS company_name, cd.lokasi
        FROM "Lowongan" l
        JOIN "User" u ON u.user_id = l.company_id
        JOIN "Company_Detail" cd ON cd.user_id = l.company_id
        WHERE l.is_open = TRUE
          AND DATE(l.updated_at) >= CURRENT_DATE - INTERVAL '6 months'
          AND l.company_id = company.company_id
          AND NOT EXISTS (
            SELECT 1
            FROM temp_applied_jobs aj
            WHERE aj.lowongan_id = l.lowongan_id
          )
        ORDER BY l.updated_at DESC
        LIMIT 3;
    END LOOP;

    

    -- All open jobs posted today, sorted by the number of applications
    INSERT INTO temp_recommendations
    SELECT l.lowongan_id, l.company_id, l.posisi, l.deskripsi, l.jenis_pekerjaan,
           l.jenis_lokasi, l.is_open, l.created_at, l.updated_at, u.nama AS company_name, cd.lokasi
    FROM "Lowongan" l
    LEFT JOIN "Lamaran" la ON la.lowongan_id = l.lowongan_id
    JOIN "User" u ON u.user_id = l.company_id
    JOIN "Company_Detail" cd ON cd.user_id = l.company_id
    WHERE l.is_open = TRUE
        AND DATE(l.updated_at) = CURRENT_DATE
        AND NOT EXISTS (
            SELECT 1
            FROM temp_applied_jobs aj
            WHERE aj.lowongan_id = l.lowongan_id
        )
    GROUP BY l.lowongan_id, l.company_id, l.posisi, l.deskripsi, l.jenis_pekerjaan,
             l.jenis_lokasi, l.is_open, l.created_at, l.updated_at, u.nama, cd.lokasi
    ORDER BY COUNT(la.lamaran_id) DESC
    LIMIT 10;

    -- If slots are still open, fill with the newest jobs
    INSERT INTO temp_recommendations
    SELECT l.lowongan_id, l.company_id, l.posisi, l.deskripsi, l.jenis_pekerjaan,
           l.jenis_lokasi, l.is_open, l.created_at, l.updated_at, u.nama AS company_names, cd.lokasi
    FROM "Lowongan" l
    JOIN "User" u ON u.user_id = l.company_id
    JOIN "Company_Detail" cd ON cd.user_id = l.company_id
    WHERE l.is_open = TRUE
        AND NOT EXISTS (
            SELECT 1
            FROM temp_recommendations tr
            WHERE tr.lowongan_id = l.lowongan_id
        )
    ORDER BY l.updated_at DESC
    LIMIT GREATEST(0, 10 - (SELECT COUNT(*) FROM temp_recommendations));

    -- Result
    RETURN QUERY
    SELECT * FROM temp_recommendations
    LIMIT 10;

    DROP TABLE temp_recommendations;
END;
$$ LANGUAGE plpgsql;
