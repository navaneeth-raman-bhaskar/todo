<link rel="stylesheet" href="{{ asset('css/app.css')}}">
<link rel="stylesheet" href="{{ asset('css/modalcss.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    .container{
        width:75%;
        margin: auto;
    }
    #board{
       background-color:ghostwhite;
    }
    h1{
        text-align: center;
        font-family:m
    }
    ::placeholder{

        color: dodgerblue;
        font-size: 20px;
        opacity: .75;
    }
    #note{
        padding-left: 100px;
        font-size: 20px;
    }
    .close{
        margin: 20px;
        font-size: 50px;
    }
    .del{
        color: red;
    }
    .del:hover{
        color: red;
    }
    .ok{
        color: green;
    }
    .ok:hover{
        color: green;
    }
    .up{
        color: #17a2b8;
    }
    .up:hover{
        color: #17a2b8;
    }
    td:first-child{
        width: 250px;
    }


</style>
<script>
    function addnew() {
        var data=document.getElementById("note").value
        var x = new XMLHttpRequest();
        x.open('GET','todo/add/' + data);
        x.send();
        x.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
               var jsondata=JSON.parse(this.response);
               var crtime=jsondata.created_at;
               var uptime=jsondata.updated_at;
               var data=jsondata.data;
               var id=jsondata.id;
               var table = document.getElementById("board");
                var row = table.insertRow(1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);


                cell1.innerHTML = data;
                cell2.innerHTML = crtime;
                cell3.innerHTML = uptime;
                cell4.setAttribute('noteId', id);
                cell4.innerHTML = " <span class=\"del close glyphicon glyphicon-remove-circle\"onclick=\"delet(this)\"></span><span class=\"up close glyphicon glyphicon-edit\"onclick=\"edit(this)\"></span>";
                //document.getElementById("board").innerHTML="<tr><td>"+data+"</td><td>"+date+"</td><td><span class=\"del close glyphicon glyphicon-remove-circle\"onclick=\"delet()\"></span> <span class=\"up close glyphicon glyphicon-edit\"onclick=\"edit()\"></span> </td></tr>";
            }
        }
    }
    function delet(e) {
        alert("Want to delete? press OK!");
        var id = e.parentElement.getAttribute('noteId');
        var x = new XMLHttpRequest();
        x.open('GET','todo/remove/' + id);

        x.send();
        x.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var status=this.responseText;
                if (status) {
                    var row=e.parentElement.parentElement;
                    row.remove();
                }
            }
        }
    }
    function refresh() {
       document.getElementById("note").value="";
    }

    function edit(e) {
        var id = e.parentElement.getAttribute('noteId');
        openModal();
        var x = new XMLHttpRequest();
        var data="updated text";
        x.open('GET','todo/edit/{id}/{data}' + id+'/'+data);
        x.send();
        x.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200){
                var status= this.responseText;
                alert("status value= "+status);
            }
        }
    }
    function openModal() {
        var modal = document.getElementById('modalId');

        document.getElementsByClassName('modalcontain')[0].style.display = "block";
exit;
// When the user clicks on <span> (x), close the modal
        document.getElementById('close').onclick = function() {
            modal.style.display = "none";
        }


    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


<div class="container">
<h1>ToDo List</h1>

    <input type="text" class="form-control" name="note" id="note" placeholder="Type note here">
    <span class="del close glyphicon glyphicon-trash" onclick="refresh()"></span>
    <span class="ok close glyphicon glyphicon-ok" onclick="addnew()"></span>

        <table id="board" class="table table-striped">
            <tr>
                <th>Note</th>
                <th>Created at</th>
                <th colspan="3">Last edited</th>
            </tr>
           @foreach($notes as $note)
              <tr>
                  <td>{{$note['data']}}</td>
                  <td>{{$note['created_at']}}</td>
                  <td>{{$note['updated_at']}}</td>
                  <td noteid="{{$note['id']}}">
                      <span class="del close glyphicon glyphicon-remove-circle"onclick="delet(this)"></span>
                      <span class="up close glyphicon glyphicon-edit"onclick="edit(this)"></span>
                  </td>
              </tr>
            @endforeach
           {{-- <tr>
                <td>Dummy</td>
                <td>2:00PM</td>
                <td>
                    <span class="del close glyphicon glyphicon-remove-circle"onclick="delet()"></span>
                    <span class="up close glyphicon glyphicon-edit"onclick="edit()"></span>
                </td>
            </tr>--}}
        </table>
</div>
    <!-- The Modal -->
    <div id="modalId" class="modalContain">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit your note</h2>
                <span class="close" id="close">&times;</span>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <buttton class="btn btn-success"></buttton><buttton class="btn btn-success"></buttton>
            </div>
        </div>

    </div>

