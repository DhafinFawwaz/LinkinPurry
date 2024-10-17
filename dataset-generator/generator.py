import json
import os
import random
import faker
import faker.generator

user_amount = 50
company_amount = 20

def get_lowongan_amount():
    return random.randint(0, 4)
def get_lamaran_amount():
    if random.random() < 0.7:
        return random.randint(0, 4)
    elif random.random() < 0.9:
        return random.randint(5, 9)
    else:
        return random.randint(10, 20)

every_password = "$2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6"

file_dir = os.path.dirname(os.path.realpath(__file__))

cv_folder = file_dir+"/../php/uploads/cv/"
videos_folder = file_dir+"/../php/uploads/videos/"
attachments_folder = file_dir+"/../php/uploads/attachments/"


cv_paths = os.listdir(cv_folder)
videos_paths = os.listdir(videos_folder)
attachments_paths = os.listdir(attachments_folder)

def get_attachment_path():
    if(len(attachments_paths) == 0 or random.random() < 0.2):
        return ""
    else: 
        return "/uploads/attachments/"+attachments_paths.pop()

def get_video_path():
    return "/uploads/videos/"+videos_paths.pop()

def get_cv_path():
    return "/uploads/cv/"+cv_paths.pop()

def get_jenis_pekerjaan():
    return random.choice(['Full Time', 'Part Time', 'Internship'])
def get_jenis_lokasi():
    return random.choice(['On-Site', 'Hybrid', 'Remote'])

data = {
    "jobseeker": [],
    "companies": [],
}

f = faker.Faker()

user_list = []

for i in range(user_amount):
    user_id = i
    email = f.email()
    username = f.name()
    data["jobseeker"].append({
        "user_id": user_id,
        "email": email,
        "username": username,
        "password": every_password,
    })
    user_list.append(user_id)

for i in range(company_amount):
    company_id = i+user_amount
    email = f.company_email()
    username = f.company()
    location = f.city()
    about = f.text(80)
    data["companies"].append({
        "company_id": company_id,
        "email": email,
        "username": username,
        "password": every_password,
        "location": location,
        "about": about,
        "lowongan": [],
    })

    for j in range(get_lowongan_amount()):
        lowongan_id = j
        posisi = f.job()
        deskripsi = f.text(80)
        jenis_pekerjaan = get_jenis_pekerjaan()
        jenis_lokasi = get_jenis_lokasi()
        attachment_path = get_attachment_path()
        data["companies"][i]["lowongan"].append({
            "lowongan_id": lowongan_id,
            "posisi": posisi,
            "deskripsi": deskripsi,
            "jenis_pekerjaan": jenis_pekerjaan,
            "jenis_lokasi": jenis_lokasi,
            "attachment_path": attachment_path,
            "lamaran": [],
        })

        try:
            user_list_copy = user_list.copy()
            for k in range(get_lamaran_amount()):
                lamaran_id = k
                user_id = user_list_copy.pop(random.randint(0, len(user_list)-1))
                cv_path = get_cv_path()
                video_path = get_video_path()
                data["companies"][i]["lowongan"][j]["lamaran"].append({
                    "lamaran_id": lamaran_id,
                    "user_id": user_id,
                    "cv_path": cv_path,
                    "video_path": video_path,
                })
        except: # if there are no more cv or video
            pass

with open(file_dir+"/data.json", "w") as f:
    json.dump(data, f)