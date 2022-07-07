<?php 
session_start();
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Form Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style-main.css">
    </head>

    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <a class="navbar-header" href="main.php">
                    <img src="assets/image/logo.png" alt="logo" style="height:50px;">
                </a>
                <strong class="nav justify-content-center"><?php echo $_SESSION['name']; ?></strong>
                <div class="nav navbar-nav navbar-right">
                    <a class="btn btn-danger" href="logout.php" role="button">Logout</a>
                </div>
            </div>
        </nav>

        <header>
            <div class="jumbotron text-center bg-dark text-light">
                <h1>Secret Message</h1>
                <h5>Website for send message to other user with privately and securely</h5>
                <p>Message encrypted with Block Cipher OFB (Output Feed Back)</p>
            </div>
            <div class="jumbotron text-center bg-secondary jumbotron-inside">
                <h5 class="text-white">Create New Message</h5>
            </div>
        </header>

        <div class="container">
            <form action="proses-tambah.php" method="POST">
                <br>
                <div class="form-group row">
                    <label for="sender" class="col-sm-2 col-form-label">Sender</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sender" readonly value="<?php echo $username ?>">
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="receiver" class="col-sm-2 col-form-label">Receiver</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="receiver" placeholder="Receiver Username" required>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject" placeholder="Subject Message" required>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="plain" class="col-sm-2 col-form-label">Plaintext</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="plain" id="plain" rows="3" placeholder="Message" required></textarea>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="key" class="col-sm-2 col-form-label">Key</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="key" placeholder="Key Must be 8 bit Binary" required>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="iv" class="col-sm-2 col-form-label">IV</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="iv" placeholder="IV Must be 8 bit Binary" required>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Process</label>
                    <div class="col-sm-10">
                        <input type="button" value="Encrypt" class="btn btn-success" id="enkripsi">
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="cipher" class="col-sm-2 col-form-label">Ciphertext</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="cipher" id="cipher" rows="3" readonly></textarea>
                    </div>
                </div><br>
                <button type="submit" class="btn btn-primary" name="tambah">Send Message</button><br><br>
            </form>
        </div>
        
        <footer>
            <div class="jumbotron text-center bg-dark text-light">
                <div class="text-center">
                    <p>A11.2019.11656 || Kriptografi 2022</p>
                </div>
            </div>
        </footer>            
    </body>
</html>
<script type="text/javascript">
    function xor(a,b){
        var ans = "";
        for (var i = 0; i < a.length; i++){
            if (a.charAt(i)==b.charAt(i)){
                ans += "0";
            }else{
                ans += "1";
            }
        }
        return ans;
    }
    function make_pt(plain) {
        var pts = [];
        for (var i = 0; i < plain.length; i++){
            var res = plain[i].charCodeAt(0).toString(2).padStart(8,'0');
            pts.push(res);
        }
        return pts;
    }
    function encryption(pts,key,iv){
        var ivc = iv;
        var cipher = [];
        for (var p in pts){
            var ik = xor(ivc, key);
            ivc = ik;
            c = xor(pts[p],ik);
            cipher.push(c);
        }
        return cipher;
    }
    var enkripsi = document.getElementById('enkripsi');
    enkripsi.onclick = function(){
        var plain = document.getElementById('plain').value;
        var key = document.getElementById('key').value;
        var iv = document.getElementById('iv').value;
        var pts = make_pt(plain);
        var cipher = encryption(pts,key,iv);
        var txt = "";
        for (var x in cipher) {
            txt += cipher[x] + " ";
        }
        document.getElementById('cipher').value = txt;
    };
</script>