<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div>
            <p>Halo {{ $user->firstName }} {{ $user->lastName }}.</p>
            <div><br></div>
            <div>Anda telah meminta pengaturan ulang kata sandi untuk akun {{ $user->firstName }} {{ $user->lastName }} account</div>
            <div><br></div>
            <div>Silakan ubah kata sandi Anda di <a href="{{ $link }}"> tautan ini </a></div>
            <div><br></div>
            <div>"jika anda tidak menyadari aktifitas ini, kemungkinan seseorang telah menyalah gunakan akun anda. segera hubungi admin untuk bantuan."</div>
            <div><br></div>
            <div>Terima Kasih</div>
        </div>
    </body>
</html>