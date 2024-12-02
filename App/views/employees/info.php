<?php ob_start() ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        scroll-behavior: smooth;
    }

    h1 {
        font-size: 2em;
    }

    .form-account {
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .logo-account {
        display: flex;
        justify-content: center;
        margin: 30px;
    }

    .logo-account ion-icon {
        font-size: 300px;
        color: #512da8;
    }

    .input-box {
        position: relative;
        margin: 20px 0;
    }

    .input-box input {
        width: 100%;
        height: 50px;
        background: transparent;
        border: 2px solid #0ef;
        border-radius: 40px;
        font-size: .7em;
        color: #000;
        padding: 0 20px;
        transition: 0.5s ease;
    }

    .input-box label {
        position: absolute;
        left: 20px;
        transform: translateY(-50%);
        color: #fff;
        pointer-events: none;
        top: 1px;
        font-size: 0.5em;
        background: #e2e2e2;
        border-color: #BAFF39;
        padding: 0 6px;
        color: #000;
    }


    .input-box input:focus~label,
    .input-box input:valid~label {
        top: 1px;
        font-size: 0.8em;
        background: #512da8;
        padding: 0 6px;
        color: #0ef;
    }

    .home ion-icon {
        color: #000;
        font-size: 50px;
        position: absolute;
        top: 0;
        left: 0;
        margin: 10px;
    }

    p a {
        color: #fff;
        text-decoration: none;
        font-size: small;
    }

    .btn {
        width: 100%;
        height: 45px;
        background: #0ef;
        border: none;
        border-radius: 40px;
        cursor: pointer;
        font-size: .7em;
        color: #1f293a;
        font-weight: 600;
        margin-top: 20px;
    }

    .btn a {
        text-decoration: none;
        color: #1f293a;
    }

    .btn2 {
        width: 100%;
        height: 45px;
        background: red;
        border: none;
        border-radius: 40px;
        cursor: pointer;
        font-size: .7em;
        color: #1f293a;
        font-weight: 600;
        margin-top: 20px;
    }

    .btn2 a {
        text-decoration: none;
        color: #1f293a;
    }

    .deconnect ion-icon {
        color: #fff;
        font-size: 30px;
        position: absolute;
        top: 0;
        right: 0;
        margin: 30px;
    }

    @media screen and (max-width: 760px) {
        form {
            margin-left: 15px;
            margin-right: 15px;
        }
    }

    @media screen and (max-width: 1280px) {
        h1 {
            margin-top: 200px;
            text-align: center;
        }
    }
</style>
<div class="form-account">
    <a href="/" class="home"><ion-icon name="arrow-back-outline"></ion-icon></a>
    <h1>Informations de votre compte</h1>
    <span class="logo-account"><ion-icon name="person-circle-outline"></ion-icon></span>
    <form action="" id="inscriptionForm" method="post">
        <div class="input-box">
            <input type="email" id="email" name="email" value="<?php echo $data['email'] ?>" readonly>
            <label>Adresse mail</label>
        </div>
        <div class="input-box">
            <input type="password" id="password" name="password" value="<?= $data['password'] ?>" readonly>
            <label>Mot de passe</label>
        </div>
    </form>

</div>

<?php
$content = ob_get_clean();

render('default', [
    'content' => $content,
], true);
?>