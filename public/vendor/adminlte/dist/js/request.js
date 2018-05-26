
var request, list = '<ul class="list-group" >', finish = false, verify = null, current_page = null, last_page = null;
var arrayUid = [];

function ListarIds(){  
    $.ajax({
        url: "http://localhost/ProjetoTG/public/tag/listar/"+$("select#product option:checked" ).val(),
        context: document.body,
        type: "GET",
        headers: {"Access-Control-Allow-Origin": "*"},
        success: function (data) {
            formPaginate(data);
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function paginate(page){
    $.ajax({
        url: "http://localhost/ProjetoTG/public/tag/listar/" + $("select#product option:checked" ).val()+"?page="+page,
        context: document.body,
        type: "GET",
        success: function (data) {
            formPaginate(data);
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function formPaginate(data){
    var options = "", paginate = "";
    current_page = data.current_page;
    last_page = data.last_page;

    for (var i = 0; i < (data.data.length == null ? 1 : data.data.length); i++) {
        options += '<tr><td><span> <i class="icon fa fa-tags"> '+data.data[i].tag_uid+'</i></span></td></tr>';
    }
    
    if(data.total > 5){
        paginate += '<nav aria-label="Page navigation example">'+
                    '<ul class="pagination">';
        if(current_page == 1){
            paginate += '<li class="page-item disabled">'+
                        '<a class="page-link" href="#" aria-label="Previous">'+
                        '<span aria-hidden="true">&laquo;</span>'+
                        '<span class="sr-only">Previous</span>'+
                        '</a>'+
                    '</li>';
        }else{
            paginate += '<li class="page-item">'+
                        '<a class="page-link" href="#" onclick="paginate('+(current_page - 1)+')" aria-label="Previous">'+
                        '<span aria-hidden="true">&laquo;</span>'+
                        '<span class="sr-only">Previous</span>'+
                        '</a>'+
                    '</li>';
        }

        var idProduto = $('select#product option:checked').val();

        for(var h = 1; h <= data.last_page; h++)
            paginate += "<li class='page-item'><a class='page-link' onclick='paginate("+h+")'>"+h+"</a></li>";

        if(last_page == current_page){
            paginate += '<li class="page-item disabled">'+
                            '<a class="page-link" href="#" aria-label="Next">'+
                            '<span aria-hidden="true">&raquo;</span>'+
                            '<span class="sr-only">Next</span>'+
                            '</a>'+
                        '</li>'+
                        '</ul>'+
                    '</nav>'; 
        }else{
            paginate += '<li class="page-item">'+
                            '<a class="page-link" href="#" onclick="paginate('+(current_page + 1)+')" aria-label="Next">'+
                            '<span aria-hidden="true">&raquo;</span>'+
                            '<span class="sr-only">Next</span>'+
                            '</a>'+
                        '</li>'+
                        '</ul>'+
                    '</nav>'; 
        }
    }
    
    $("#paginate").html(paginate).show();
    $('#lista').html(options).show();
    $('#total').html("Total: " + data.total).show();
}

function create(){
    $.ajax({
        url: "http://localhost/ProjetoTG/public/tag/create/" + arrayUid + "&" + $("select#product option:checked" ).val(),
        context: document.body,
        type: "GET",
        success: function (data) {
            list = "";
            $('#list-group').html(list).show();
            arrayUid = [];
            $('#modal-info').modal("hide");
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function verifyTag(uid){
    $.ajax({
        url: "http://localhost/ProjetoTG/public/tag/verify/" + uid,
        context: document.body,
        type: "GET",
        async: false,
        success: function (data) {
            var product = "", tag = "";
            if(data.productTag[0]){
                //$("select#product option:checked" ).val(data[0].product_id);
                for(var x = 0; x < data.product.length; x++){
                    product += '<option value="' + data.product[x].id + '">' + data.product[x].description + '</option>';
                }

                tag += '<div class="offset-sm-0 col-md-4 offset-md-4"></div><li class="list-group-item col-sm-12 col-md-4 text-muted text-center"><i class="icon fa fa-tags"></i>  '+data.productTag[0].tag_uid+'</li>';
                
                $('#modal-success').modal('hide');
                $('#modal-verify').modal('show');
                $('#tag-verify').html(product).show();
                $('#tag').html(tag).show();
                verify = false;
            }else{
                verify = true;
            }
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function listarUid(){
    $.ajax({
        url: "http://192.168.0.101/",
        //url: "http://192.168.147.50/",
        //url: "http://192.168.103.20/",
        //url: "http://192.168.107.46/",
        context: document.body,
        type: "GET",
        success: function (data) {
            verificarUid(data.data[0].uid);
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function verificarUid(uid){
    $.ajax({
        url: "http://localhost/ProjetoTG/public/tag/showTag/"+uid,
        context: document.body,
        type: "GET",
        success: function (data) {
            var options = "";
            if(data.data != 0){
                //options = data.data[0].uid;
                lcd(data[0].product.description, data[0].product.price);
                //teste(data[0].product.description);
                //alert(data[0].product.description);
            }else{
                options = data.data;
            }
            
            //$('#modal-body').html(options).show();
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function lcd(name, price){
    $.ajax({
        url: "http://192.168.0.101/lcd?name="+name+"&price="+price,
        //url: "http://192.168.147.50/lcd?name="+name+"&price="+price,
        //url: "http://192.168.103.20/lcd?name="+name+"&price="+price,
        //url: "http://192.168.107.46/lcd?name="+name+"&price="+price,
        context: document.body,
        type: "GET",
        headers: {"Access-Control-Allow-Origin": "*"},
        success: function (data) {
            /*var options = "";
            if(data.data != 0)
                options = data.data[0].r;
            else
                options = data.data;
            */
            
            //$('#modal-body').html(options).show();
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function makeRequestFull(){
    $.ajax({
        url: "http://192.168.103.187/cadastro",
        //url: "http://192.168.147.50/cadastro",
        //url: "http://192.168.103.20/cadastro",
        context: document.body,
        type: "GET",
        success: function (data) {
            var options = "";
            if(data.data != 0){
                //alert(data.data[0].uid);
                if(finish != true){
                    if(data.data[0].uid != "nda"){
                        verifyTag(data.data[0].uid);
                        if(verify == true){
                            if(arrayUid.toString().search(data.data[0].uid) <= -1){
                                for (var i = 0; i < data.data.length; i++) {
                                    options += '<li class="list-group-item col-sm-4 text-muted"><i class="icon fa fa-tags"></i>  '+data.data[i].uid+'</li>';
                                }
                            
                                arrayUid.push(data.data[0].uid);
                            }
                        }
                        verify = null;
                    }else{
                        makeRequestFull();
                    }
                    makeRequestFull();
                }
            }else{
                if(finish != true){
                    if(data.data[0].uid != "nda"){
                        for (var i = 0; i < data.length; i++) {
                            options += "<div class='col-sm-3'>";
                            options += "   <div class='lert alert-success alert-dismissible'>";
                            options += "      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
                            options += "      <h6><i class='icon fa fa-tags'></i> "+data[i].uid+"</h6>";
                            options += "   </div>";
                            options += "</div> ";                  
                        }
                        arrayUid.push(data[0].uid);
                    }else{
                        makeRequestFull();
                    }
                    makeRequestFull();
                }
            }
            
            list += options;
            $('#list-group').html(list).show();
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

function terminar(){
    finish = true;
}

function start(){
    finish = false;
}

$('#teste2').click(function(){
    $('#modal-verify').modal('show');
});

function carregaNotificacao(){
    $.ajax({
        url: "http://localhost/ProjetoTG/public/notification/list",
        context: document.body,
        type: "GET",
        headers: {"Access-Control-Allow-Origin": "*"},
        success: function (data) {
            var notificate = "";
            notificate += '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
                            '<i class="glyphicon glyphicon-bell"></i>'+
                            '<span class="label label-warning">'+data.length+'</span>'+
                        '</a>'+
                        '<ul class="dropdown-menu">'+
                            '<li class="header">Você tem '+data.length+' Notificações</li>'+
                            '<li>'+
                            '<ul class="menu">';
                for(var x = 0;x<data.length;x++){
                    notificate += '<li>'+
                                    '<a href="#">'+
                                        '<i class="glyphicon glyphicon-bell text-aqua"></i> '+data[x].description+
                                    '</a>'+
                                    '</li>';
                }
                notificate += '</ul>'+
                                '</li>'+
                                '<li class="footer"><a href="http://localhost/ProjetoTG/public/notification/visualizar">View all</a></li>'+
                                '</ul>';
            $("#teste").html(notificate).show();
        },
        error: function(xhr, textStatus, error) {
            console.log(xhr.responseText);
            console.log(textStatus);
            console.log(error);
        }
    });
}

setInterval(carregaNotificacao(), 60000);