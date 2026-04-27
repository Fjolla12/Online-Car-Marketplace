# Online-Car-Marketplace

## Përshkrimi i projektit
Ky është një aplikacion web i ndërtuar me PHP për menaxhimin e një marketplace për makina. Projekti demonstron përdorimin e koncepteve bazë të zhvillimit si struktura modulare, menaxhimi i përdoruesve dhe kontrolli i aksesit.

## Struktura e projektit
- config/config.php -> konfigurimi dhe kredencialet
- includes/header.php -> header
- includes/nav.php -> navigimi
- includes/footer.php -> footer
- includes/auth.php -> autentifikimi dhe kontrolli i aksesit
- classes/User.php -> klasa User
- classes/Admin.php -> klasa Admin
- classes/Validator.php -> validimi i inputeve
- pages/home.php -> lista e veturave
- pages/dashboard.php -> dashboard
- pages/profile.php -> profili
- pages/admin.php -> paneli admin
- login.php -> login
- logout.php -> logout
- index.php -> faqja kryesore

## Autentifikimi
Sistemi i autentifikimit menaxhon kyqjen, çkyçjen dhe kontrollin e aksesit të përdoruesve në aplikacion.
Autentifikimi realizohet duke verifikuar kredencialet e ruajtura në konfigurim. Pas login-it të suksesshëm, të dhënat e përdoruesit ruhen në session për të mundësuar identifikimin e tij gjatë navigimit në aplikacion.
Kontrolli i aksesit bazohet në role (user dhe admin), ku funksione të dedikuara verifikojnë nëse përdoruesi është i kyçur dhe nëse ka të drejtë për të hyrë në faqe të caktuara.

Ky funksionalitet është i implementuar përmes këtyre file-ve:
- config/config.php
Përmban inicializimin e session dhe kredencialet statike të përdoruesve.
- includes/auth.php
Përmban funksione për kontrollin e autentifikimit dhe autorizimit (login check dhe role check).
- login.php
Menaxhon procesin e autentifikimit duke verifikuar kredencialet dhe duke krijuar session për përdoruesin.
- logout.php
Shkatërron session dhe largon përdoruesin nga sistemi.
