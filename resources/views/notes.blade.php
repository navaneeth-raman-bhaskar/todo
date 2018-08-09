<link rel="stylesheet" href="{{ asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    .container{
        width:50%;
        margin: auto;
    }
    .board{
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

</style>
<script>
    function addnew() {
        var data=document.getElementById("note").value
        var x = new XMLHttpRequest();
        x.open('GET','todo/add/' + data);
        x.send();
        x.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                var jsondata=JSON.parse(this.responseText);
               var date=jsondata.time;
               var data=jsondata.data;

               var table = document.getElementById("board");

                var row = table.insertRow(1);

                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);

                cell1.innerHTML = data;
                cell2.innerHTML = date;
                cell3.innerHTML = " <span class=\"del close glyphicon glyphicon-remove-circle\"onclick=\"delet()\"></span><span class=\"up close glyphicon glyphicon-edit\"onclick=\"edit()\"></span>";
                //document.getElementById("board").innerHTML="<tr><td>"+data+"</td><td>"+date+"</td><td><span class=\"del close glyphicon glyphicon-remove-circle\"onclick=\"delet()\"></span> <span class=\"up close glyphicon glyphicon-edit\"onclick=\"edit()\"></span> </td></tr>";
            }
        }
    }
    function delet() {
        alert("deleted");
        var x = new XMLHttpRequest();
        x.open('GET','delete' + id);
        x.send();
        x.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("board").innerHTML = this.responseText;
            }
        }
    }
    function refresh() {
       document.getElementById("note").value="";
    }

    function edit() {
        alert("edited");
        var x = new XMLHttpRequest();
        x.open('GET','edit' + id);
        x.send();
        x.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("board").innerHTML = this.responseText;
            }
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
                <th colspan="3">Last edited</th>
            </tr>
           @foreach($notes as $note)
              <tr>
                  <td>{{$note['data']}}</td>
                  <td>{{$note['time']}}</td>
                  <td>
                      <span class="del close glyphicon glyphicon-remove-circle"onclick="delet()"></span>
                      <span class="up close glyphicon glyphicon-edit"onclick="edit()"></span>
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