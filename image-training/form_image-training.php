<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Image Training</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <form>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" accept="image/*" id="image">
                    </div>

                    <div class="mb-3">
                        <label for="image-training" class="form-label">Training Image (multiple)</label>
                        <input type="file" class="form-control" accept="image/*" id="image-training" multiple>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address">
                    </div>

                    <div class="mb-4">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik">
                    </div>


                    <button type="button" class="btn btn-primary" id="submit-form">Submit</button>
                    <button type="button" class="btn btn-primary" id="start-training">Start Data Training</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let submitBtn = document.querySelector("#submit-form");
        submitBtn.addEventListener("click", (e) => {
            sendData();
        })

        let startBtn = document.querySelector("#start-training");
        startBtn.addEventListener("click", (e) => {
            startTraining();
        })

        function startTraining() {
            let xmlHttp = new XMLHttpRequest();
            // xmlHttp.timeout = 900000; // 15min
            xmlHttp.onreadystatechange = function() {

                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    alert(xmlHttp.responseText);
                }

            }

            xmlHttp.onerror = function(err) {
                console.log(err);
            }

            xmlHttp.open("get", "start_image-training");
            xmlHttp.send();
        }

        function sendData() {
            
            var formData = new FormData();

            let profpic = null;
            if (document.querySelector("#image").files.length > 0) {
                profPic = document.querySelector("#image").files[0]
                formData.append("profpic", profPic);
            } else {
                alert("Input profpic!");
            }

            let trainingImage = [];
            if (document.querySelector("#image-training").files.length > 0) {
                trainingImage = document.querySelector("#image-training").files;
                Array.from(trainingImage).forEach(file => {
                    formData.append("training[]", file);
                })
            } else {
                alert("Input training image!");
            }

            let name = "";
            if (document.querySelector("#name").value.trim() !== "") {
                name = document.querySelector("#name").value;
                formData.append("name", name);
            } else {
                alert("Input name!");
            }

            let address = "";
            if (document.querySelector("#address").value.trim() !== "") {
                address = document.querySelector("#address").value;
                formData.append("address", address);
            } else {
                alert("Input address!");
            }

            let nik = "";
            if (document.querySelector("#nik").value.trim() !== "") {
                nik = document.querySelector("#nik").value;
                formData.append("nik", nik);
            } else {
                alert("Input nik!");
            }

            formData.append("time", new Date().getTime().toString());

            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            let xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function() {

                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    console.log(xmlHttp.responseText);

                    if (xmlHttp.responseText == "Success") {
                        alert("Data uploaded successfully");
                    } else {
                        alert(xmlHttp.responseText);
                    }
                }

            }

            xmlHttp.onerror = function(err) {
                console.log(err);
            }

            xmlHttp.open("post", "submit_image-training");
            xmlHttp.send(formData);


            // IP 
            // UPLOAD BIASA http://103.94.169.26:8349/upload/
            // TRAINING http://103.94.169.26:8349/train/
        }
    </script>
</body>

</html>