<?php
  session_start();
  if(isset($_SESSION['usrid']))
  {
    ?>
<script>
alert("Welcome <?= $_SESSION['usrid'] ?>");
</script>
<?php
  }
  else
  {
    header('location:index.php');
  }
?>


<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <title>CLOUD</title>
    
    <style>
    body {
        background-image: linear-gradient(to right, #00e7ef, #ff0dff, #00e7ef, #ff0dff, #00e7ef);
    }

    .banner {}
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://chinmayakumarbiswal.in/favicon.ico" alt="" width="30" height="24">
                CHINMAYA
            </a>
            <form class="d-flex" id>
                <a href="logout.php">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal">
                        Logout
                    </button></a>

            </form>
        </div>
    </nav>
    <section>


        <div class="container my-3">
            <h1>Take your Notes here</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Add a Note

                    </h5>
                    <div class="form-group">
                        <textarea class="form-control" id="addTxt" rows="3">
                    </textarea>
                    </div>
                    <button class="btn btn-primary" id="addBtn" style="background-color:green">
                        Add Note
                    </button>
                </div>
            </div>
            <hr>
            <h1>Your Notes</h1>
            <hr>

            <div id="notes" class="row container-fluid">
            </div>
        </div>
    </section>


    <script>
    showNotes();

    // If user adds a note, add it to the localStorage
    let addBtn = document.getElementById("addBtn");
    addBtn.addEventListener("click", function(e) {
        let addTxt = document.getElementById("addTxt");
        let notes = localStorage.getItem("notes");

        if (notes == null) notesObj = [];
        else notesObj = JSON.parse(notes);

        notesObj.push(addTxt.value);
        localStorage.setItem("notes", JSON.stringify(notesObj));
        addTxt.value = "";

        showNotes();
    });

    // Function to show elements from localStorage
    function showNotes() {
        let notes = localStorage.getItem("notes");

        if (notes == null) notesObj = [];
        else notesObj = JSON.parse(notes);

        let html = "";

        notesObj.forEach(function(element, index) {
            html += `<div class="noteCard my-2 mx-2 card" 
              style="width: 18rem;">
                  <div class="card-body">
                      <h5 class="card-title">
                          Note ${index + 1}
                      </h5>
                      <p class="card-text"> 
                          ${element}
                      </p>
     
                    <button id="${index}" onclick=
                      "deleteNote(this.id)"
                      class="btn btn-primary">
                      Delete Note
                  </button>
              </div>
          </div>`;
        });

        let notesElm = document.getElementById("notes");

        if (notesObj.length != 0) notesElm.innerHTML = html;
        else
            notesElm.innerHTML = `Nothing to show! 
          Use "Add a Note" section above to add notes.`;
    }

    // Function to delete a note
    function deleteNote(index) {
        let notes = localStorage.getItem("notes");

        if (notes == null) notesObj = [];
        else notesObj = JSON.parse(notes);

        notesObj.splice(index, 1);

        localStorage.setItem("notes",
            JSON.stringify(notesObj));

        showNotes();
    }
    </script>


</body>

</html>