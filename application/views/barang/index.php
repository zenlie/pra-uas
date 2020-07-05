<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Barang</a>
        </li>
        <li class="breadcrumb-item active">Data Barang</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-list"></i> Barang
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModalBarang">Tambah barang</button>
        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Barang</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="tbodyBarang">
                    </tbody>                    
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Barang</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="myModalBarang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
            Tambah
      </div>
      <div class="modal-body">
        <form id="formBarang">
            <input type="text" id='c_id_barang' class="form-control" placeholder="id barang">
            <input type="text" id='c_nm_barang' class="form-control" placeholder="nama barang">
            <input type="text" id='c_stok_barang' class="form-control" placeholder="stok barang">
            <input type="text" id='c_harga_barang' class="form-control" placeholder="harga barang">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="createBarang()">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModalBarangEdit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
            Edit
      </div>
      <div class="modal-body">
        <form id="formBarang">
            <input type="text" id='e_id_barang' class="form-control" readonly>
            <input type="text" id='e_nm_barang' class="form-control" >
            <input type="text" id='e_stok_barang' class="form-control" >
            <input type="text" id='e_harga_barang' class="form-control">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="editBarang()">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>

    window.onload = function() {
      getDataBarang();
    };

    function getDataBarang(){
        $.ajax({ 
            type: 'GET', 
            url: 'http://localhost/abs/api/ApiBarang', 
            data: {}, 
            dataType: 'json',
            success: function (data) { 
                if(data != '') {
                    html_val = '';
                    no = 1;
                    jQuery.each(data, function(i, val) {
                        html_val += '<tr>';
                        html_val += '<td align="center">'+no+'</td>';
                        html_val += '<td>'+val.id_barang+'</td>';
                        html_val += '<td>'+val.nm_barang+'</td>';
                        html_val += '<td>'+val.stok_barang+'</td>';
                        html_val += '<td>'+val.harga_barang+'</td>';
                        html_val += '<td>';
                        html_val += '<button data-id="'+val.id_barang+'" class="btn btn-sm btn-outline-secondary" style="padding-bottom: 0px; padding-top: 0px;" onclick="get_barang(this)"> Edit <span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span></button>';
                        html_val += '<button data-id="'+val.id_barang+'" class="btn btn-sm btn-outline-danger" style="padding-bottom: 0px; padding-top: 0px;" onclick="delete_barang(this)"> Hapus <span class="btn-label btn-label-right"><i class="fa fa-trash"></i></span></button>';                    
                        html_val += '</tr>';
                        no++;
                    });
                    $('.tbodyBarang').html(html_val);  
                }else{      
                    $('.tbodyBarang').html('<tr><td colspan="24" align="center">Tidak ada data ditahun '+ta+'</td></tr>'); 
                }              

            }
        });
    }

    function createBarang(){
        var secret_key = $('#secret_key').val();

        var id_barang = $('#c_id_barang').val();
        var nm_barang = $('#c_nm_barang').val();
        var stok_barang = $('#c_stok_barang').val();
        var harga_barang = $('#c_harga_barang').val();
        $.ajax({
            type : "POST",
            url  : "http://localhost/abs/api/ApiBarang/create",
            headers: {"secret_key": secret_key},
            data : {'id_barang':id_barang, 'nm_barang':nm_barang, 'stok_barang':stok_barang, 'harga_barang':harga_barang},
            datatype: "json",
            success: function(result){
                $('#myModalBarang').modal('hide');
                getDataBarang();
            },
            error: function(){
            }
        });
    }

    function get_barang(_this){
        var secret_key = $('#secret_key').val();
        var id_barang = $(_this).data("id");

        $.ajax({
            type : "GET",
            url  : "http://localhost/abs/api/ApiBarang",
            headers: {"secret_key": secret_key},
            data : {'id_barang':id_barang},
            datatype: "json",
            success: function(data){
                if(data != '') {
                    html_val = '';
                    no = 1;
                    jQuery.each(data, function(i, val) {
                        console.log(val.id_barang);
                        $("#e_id_barang").val(val.id_barang);
                        $("#e_nm_barang").val(val.nm_barang);
                        $("#e_stok_barang").val(val.stok_barang);
                        $("#e_harga_barang").val(val.harga_barang);
                    });
                }
                $('#myModalBarangEdit').modal('show');
            },
            error: function(){
            }
        });
    }

    function editBarang(){
        var secret_key = $('#secret_key').val();

        var id_barang = $('#e_id_barang').val();
        var nm_barang = $('#e_nm_barang').val();
        var stok_barang = $('#e_stok_barang').val();
        var harga_barang = $('#e_harga_barang').val();

        $.ajax({
            type : "POST",
            url  : "http://localhost/abs/api/ApiBarang/update",
            headers: {"secret_key": secret_key},
            data : {'id_barang':id_barang, 'nm_barang':nm_barang, 'stok_barang':stok_barang, 'harga_barang':harga_barang},
            datatype: "json",
            success: function(result){
                $('#myModalBarangEdit').modal('hide');
                getDataBarang();
            },
            error: function(result){
            }
        });
    }

    function delete_barang(_this){
        var secret_key = $('#secret_key').val();
        var id_barang = $(_this).data("id");

        $.ajax({
            type : "POST",
            url  : "http://localhost/abs/api/ApiBarang/delete",
            headers: {"secret_key": secret_key},
            data : {'id_barang':id_barang},
            datatype: "json",
            success: function(result){
                $('#myModalBarang').modal('hide');
                getDataBarang();
            },
            error: function(){
            }
        });
    }

</script>