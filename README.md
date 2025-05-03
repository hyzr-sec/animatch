# 🐾 Animatch

Animatch is a lightweight web application built with the **LAMP stack** (Linux, Apache, MySQL, PHP) designed to streamline the process of animal adoption. It connects shelters with potential adopters in a clean, responsive interface.

---

## 🚀 Features

- 🔒 User authentication (login/register)
- 🐶 Animal listing (available animals with photos & info)
- ❤️ Adoption request system
- 📁 Profile picture upload
- 🧑‍💻 Admin/moderator ready (can be extended)
- 📱 Mobile-friendly UI

---

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP (vanilla)
- **Database:** MySQL
- **Server:** Apache

---

## 📂 Folder Structure

```
Animatch/
├── assets/
│   └── uploads/profiles/        # Uploaded profile images
├── db.php                       # DB connection
├── login.php / register.php     # Auth pages
├── dashboard.php                # User home
├── request_adoption.php         # Handle adoption logic
└── ... (other core PHP files)
```

---

## ⚙️ Setup Instructions

1. **Clone the repo:**

   ```bash
   git clone https://github.com/hyzr/animatch.git
   cd animatch
   ```

2. **Import the MySQL database:**

   - Import `animatch.sql` into your MySQL server.

3. **Configure database:**

   - Edit `db.php` with your own MySQL credentials.

4. **Run on local server:**

   - Place in your web root (e.g., `/var/www/html/animatch`)
   - Start Apache and MySQL
   - Visit `http://localhost/animatch`

---

## 💡 Notes

- Uploaded profile images are stored in `assets/uploads/profiles/`
- Use `$_SESSION` to pass alerts between pages
- Secure file uploads with type & size checks
- Extendable for admin dashboards, filtering, etc.

---

## 📃 License

MIT — feel free to fork, modify, and improve!

---

## 🙌 Credits

Built by [hyzr - Hela], 2025.
