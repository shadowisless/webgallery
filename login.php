    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    body {
    font-family: 'Comfortaa', sans-serif;
    background: linear-gradient(to bottom, #76453B, #C38154, #F1E4C3);
    color: #3A4D39;
}
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column; 
}
.card {
    width: 350px;
    border: none;
    border-radius: 10px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    color:  #3A4D39;
    font-weight: bold;
}
.card-header {
    background: linear-gradient(to right, #557A46, #7A9D54);
    color: #fff;
    border-radius: 10px 10px 0 0;
    font-weight: bold;
    text-align: center;
    padding: 15px;
}
.card-body {
    padding: 30px;
}
.btn-primary {
    background-color: #7A9D54;
    border: none;
    border-radius: 20px;
    padding: 10px 25px;
}
.btn-primary:hover {
    background-color: #557A46;
}
.footer {
    margin-top: 20px;
    text-align: center;
    color: white;
}
.footer a {
    color: #3A4D39;
    text-decoration: none;
}
.footer a:hover {
    text-decoration: underline;
}
.mt-3:hover{
    color: #3A4D39;
}
</style>
    </head>
    <body>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    Halaman Login
                </div>
                <div class="card-body">
                    <form action="proses_login.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
            <div class="footer">
                Belum punya akun? <a href="register.php">Daftar di sini</a>
                <br>
                <a href="index.php" class="btn mt-3">Kembali ke Halaman Utama</a>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const submitButton = document.querySelector('button[type="submit"]');
            submitButton.addEventListener('click', function() {
                submitButton.style.backgroundColor = '#114232';
            });
        });
        </script>
    </body>

    </html>
    <script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', function(e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.querySelector('i').classList.toggle('fa-eye-slash');
});
    </script>