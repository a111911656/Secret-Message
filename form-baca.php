<?php

session_start();

include("config.php");

if( !isset($_GET['kode']) ){
    header('Location: main.php');
}

$id = $_GET['kode'];

$sql = "SELECT * FROM message WHERE id='$id'";
$query = mysqli_query($db, $sql);
$pesan = mysqli_fetch_assoc($query);

if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
}

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
                <h5 class="text-white">Read Message</h5>
            </div>
        </header>

        <div class="container">
            <form>
                <br>
                <div class="form-group row">
                    <label for="sender" class="col-sm-2 col-form-label">Sender</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sender" readonly value="<?php echo $pesan['sender'] ?>">
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="receiver" class="col-sm-2 col-form-label">Receiver</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="receiver" readonly value="<?php echo $pesan['receiver'] ?>">
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject" readonly value="<?php echo $pesan['subject'] ?>">
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="cipher" class="col-sm-2 col-form-label">Ciphertext</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="cipher" id="cipher" rows="3" readonly><?php echo $pesan['text'] ?></textarea>
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
                        <input type="button" value="Decrypt" class="btn btn-success" id="dekripsi">
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="plain" class="col-sm-2 col-form-label">Plaintext</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="plain" id="plain" rows="3" readonly></textarea>
                    </div>
                </div><br>
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
    function make_cp(cipher) {
        var cps = cipher.split(" ");
        cps.pop();
        return cps;
    }
    function decryption(cps,key,iv){
        var ivp = iv;
        var plain = [];
        for (var c in cps){
            var ik = xor(ivp, key);
            ivp = ik;
            p = xor(cps[c],ik);
            plain.push(p);
        }
        return plain;
    }
    var dekripsi = document.getElementById('dekripsi');
    dekripsi.onclick = function(){
        var cipher = document.getElementById('cipher').value;
        var key = document.getElementById('key').value;
        var iv = document.getElementById('iv').value;
        var cps = make_cp(cipher);
        var plain = decryption(cps,key,iv);
        var result = "";
        for (var i = 0; i < plain.length; i++) {
            result += String.fromCharCode(parseInt(plain[i], 2).toString(10));
        }
        document.getElementById('plain').value = result;
    };
</script>