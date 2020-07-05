<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">User</a>
        </li>
        <li class="breadcrumb-item active">Data User</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-list"></i> User
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModalUser">Tambah user</button>
        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Nama</th>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>EMAIL_USER</th>
                            <th>LEVEL_USER</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="tbodyUser">
                    </tbody>                    
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Nama</th>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>EMAIL_USER</th>
                            <th>LEVEL_USER
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="myModalUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
            Tambah
      </div>
      <div class="modal-body">
        <form id="formUser">
            <input type="text" id='c_id_User' class="form-control" placeholder="id User">
            <input type="text" id='c_nm_User' class="form-control" placeholder="nama User">
            <input type="text" id='c_stok_User' class="form-control" placeholder="stok User">
            <input type="text" id='c_harga_User' class="form-control" placeholder="harga User">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="createUser()">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModalUserEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
            Edit
      </div>
      <div class="modal-body">
        <form id="formUser">
            <input type="text" id='e_id_User' class="form-control" readonly>
            <input type="text" id='e_nm_User' class="form-control" >
            <input type="text" id='e_stok_User' class="form-control" >
            <input type="text" id='e_harga_User' class="form-control">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="editUser()">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>

    window.onload = function() {
      getDataUser();
    };

    function getDataUser(){
        $.ajax({ 
            type: 'GET', 
            url: 'http://localhost/abs/api/ApiUser', 
            data: {}, 
            dataType: 'json',
            success: function (data) { 
                if(data != '') {
                    html_val = '';
                    no = 1;
                    jQuery.each(data, function(i, val) {
                        html_val += '<tr>';
                        html_val += '<td align="center">'+no+'</td>';
                        html_val += '<td>'+val.id_User+'</td>';
                        html_val += '<td>'+val.nm_User+'</td>';
                        html_val += '<td>'+val.stok_User+'</td>';
                        html_val += '<td>'+val.harga_User+'</td>';
                        html_val += '<td>';
                        html_val += '<button data-id="'+val.id_User+'" class="btn btn-sm btn-outline-secondary" style="padding-bottom: 0px; padding-top: 0px;" onclick="get_User(this)"> Edit <span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span></button>';
                        html_val += '<button data-id="'+val.id_User+'" class="btn btn-sm btn-outline-danger" style="padding-bottom: 0px; padding-top: 0px;" onclick="delete_User(this)"> Hapus <span class="btn-label btn-label-right"><i class="fa fa-trash"></i></span></button>';                    
                        html_val += '</tr>';
                        no++;
                    });
                    $('.tbodyUser').html(html_val);  
                }else{      
                    $('.tbodyUser').html('<tr><td colspan="24" align="center">Tidak ada data ditahun '+ta+'</td></tr>'); 
                }              

            }
        });
    }

    function createUser(){
        var secret_key = $('#secret_key').val();

        var id_User = $('#c_id_User').val();
        var nm_User = $('#c_nm_User').val();
        var stok_User = $('#c_stok_User').val();
        var harga_User = $('#c_harga_User').val();
        $.ajax({
            type : "POST",
            url  : "http://localhost/abs/api/ApiUser/create",
            headers: {"secret_key": secret_key},
            data : {'id_User':id_User, 'nm_User':nm_User, 'stok_User':stok_User, 'harga_User':harga_User},
            datatype: "json",
            success: function(result){
                $('#myModalUser').modal('hide');
                getDataUser();
            },
            error: function(){
            }
        });
    }

    function get_User(_this){
        var secret_key = $('#secret_key').val();
        var id_User = $(_this).data("id");

        $.ajax({
            type : "GET",
            url  : "http://localhost/abs/api/ApiUser",
            headers: {"secret_key": secret_key},
            data : {'id_User':id_User},
            datatype: "json",
            success: function(data){
                if(data != '') {
                    html_val = '';
                    no = 1;
                    jQuery.each(data, function(i, val) {
                        console.log(val.id_User);
                        $("#e_id_User").val(val.id_User);
                        $("#e_nm_User").val(val.nm_User);
                        $("#e_stok_User").val(val.stok_User);
                        $("#e_harga_User").val(val.harga_User);
                    });
                }
                $('#myModalUserEdit').modal('show');
            },
            error: function(){
            }
        });
    }

    function editUser(){
        var secret_key = $('#secret_key').val();

        var id_User = $('#e_id_User').val();
        var nm_User = $('#e_nm_User').val();
        var stok_User = $('#e_stok_User').val();
        var harga_User = $('#e_harga_User').val();

        $.ajax({
            type : "POST",
            url  : "http://localhost/abs/api/ApiUser/update",
            headers: {"secret_key": secret_key},
            data : {'id_User':id_User, 'nm_User':nm_User, 'stok_User':stok_User, 'harga_User':harga_User},
            datatype: "json",
            success: function(result){
                $('#myModalUserEdit').modal('hide');
                getDataUser();
            },
            error: function(result){
            }
        });
    }

    function delete_User(_this){
        var secret_key = $('#secret_key').val();
        var id_User = $(_this).data("id");

        $.ajax({
            type : "POST",
            url  : "http://localhost/abs/api/ApiUser/delete",
            headers: {"secret_key": secret_key},
            data : {'id_User':id_User},
            datatype: "json",
            success: function(result){
                $('#myModalUser').modal('hide');
                getDataUser();
            },
            error: function(){
            }
        });
    }

</script>