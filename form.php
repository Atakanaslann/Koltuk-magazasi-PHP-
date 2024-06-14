<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim Formu</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>
<body>
    <form action="process_form.php" method="POST" class="p-5 bg-white">
        <h2 class="h4 text-black mb-5">İLETİŞİME GEÇ</h2> 

        <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">İSİM</label>
                <input type="text" id="fname" name="fname" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="text-black" for="lname">SOYİSİM</label>
                <input type="text" id="lname" name="lname" class="form-control" required>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <label class="text-black" for="email">EMAIL</label> 
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <label class="text-black" for="message">MESAJ</label> 
                <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Mesajınızı Buraya Yazın.." required></textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <input type="submit" value="Mesaj Gönder" class="btn btn-primary btn-md text-white">
            </div>
        </div>
    </form>
</body>
</html>
