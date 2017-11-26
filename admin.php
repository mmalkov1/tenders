
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title></title>
    
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/3/paper/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="css/table.css" type="text/css"/>

</head>
<body>


<div id="table">

    <table id = "container" class = "table" style="font-size: 12px" >

        <thead>
        <tr id="head">
            <th id="0">Номер п/п </th>
            <th id="1">Ф.И.О. сотрудника</th>
            <th id="8">Логин</th>
            <th id="2">e-mail</th>
            <th id="9">Администратор</th>
            <th id="3">Координатор</th>
            <th id="4">Менеджер</th>
            <th id="5">Тендерный отдел</th>
            <th id="6">Закупка</th>
            <th id="7">Тендер получил</th>
            <th id="42">Ред.</th>
            <th id="43">Уд.</th>
        </tr>

        </thead>


    </table>


</div>




<div style="width: 80%; padding-left: 10%">
    <form method="post" class="modal form" id="insert_form" style="display: none; width: 60%; padding-left: 20%" >
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Данные пользователя</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab1" class="form-group tab-pane active">
                <label class="control-label col-sm-2 col-lg-2">Ф.И.О. сотрудника</label>
                <div class="col-sm-4 col-lg-4">
                    <input name="user_name" id="user_name" class="form-control"></input>
                </div>
                <label class="control-label col-sm-2 col-lg-2">Логин</label>
                <div class="col-sm-4 col-lg-4">
                    <input name="login" id="login" class="form-control"></input>
                </div>
                <label class="control-label col-sm-12 col-lg-12 "></label>
                <label class="control-label col-sm-2 col-lg-2">e-mail</label>
                <div class="col-sm-4 col-lg-4">
                    <input name="user_mail" id="user_mail" class="form-control"></input>
                </div>

                <label class="control-label col-sm-2 col-lg-2">Пароль</label>
                <div class="col-sm-4 col-lg-4">
                    <input name="user_password" id="user_password" class="form-control"></input>
                </div>
                <label class="control-label col-sm-12 col-lg-12 "></label>
                <label class="control-label col-sm-2 col-lg-2 ">Админ</label>
                <div class="col-sm-2 col-lg-2">
                    <input name="administrator" id="administrator" class="form-control"></input>
                </div>
                <label class="control-label col-sm-2 col-lg-2 ">Координатор</label>
                <div class="col-sm-2 col-lg-2">
                    <input name="koordinator" id="koordinator" class="form-control"></input>
                </div>
                <label class="control-label col-sm-2 col-lg-2">Менеджер</label>
                <div class="col-sm-2 col-lg-2">
                    <input name="manager" id="manager" class="form-control"></input>
                </div>
                <label class="control-label col-sm-12 col-lg-12 "></label>
                <label class="control-label col-sm-2 col-lg-2">Тендерный отдел</label>
                <div class="col-sm-2 col-lg-2">
                    <input name="tender" id="tender" class="form-control"></input>
                </div>
                <label class="control-label col-sm-2 col-lg-2">Закупщик</label>
                <div class="col-sm-2 col-lg-2">
                    <input name="purchase" id="purchase" class="form-control"></input>
                </div>
                <label class="control-label col-sm-2 col-lg-2">Тендер получил</label>
                <div class="col-sm-2 col-lg-2">
                    <input name="tender_got" id="tender_got" class="form-control"></input>
                </div>
                <label class="control-label col-sm-12 col-lg-12 "></label>
            </div>


        </div>
        <div class="controls col-sm-12 col-lg-12">
            <input type="hidden" id="id" name="id" value="0"/>
            <input type="hidden" id="option" name="option" value="edit_user"/>
            <input type="submit" name="insert" id="insert" value="Insert" class="button btn btn-primary col-sm-offset-2" onclick="$('#insert_form').hide()"/>
            <button type="button" class="btn btn-danger" id = "spisok" onclick="$('#insert_form').hide(); $('#table').show()">Отмена</button>

        </div>
    </form>
</div>


<div class="col-sm-offset-2 col-sm-8">

    <p class="message"></p>

</div>
<form id="ModalFormDeleteData" action="" method="POST" >
    <input type="hidden" id="id" name="id" value="0"/>
    <input type="hidden" id="option" name="option" value="delete_user"/>
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog"
         aria-labelledby="ModalHeader">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalHeader">Удаление пользователя</h4>

                </div>

                <div class="modal-body" >

                    Вы действительно хотите удалить пользователя?<strong data-name=""></strong>

                </div>

                <div class="modal-footer">

                    <button type="button" id="delete_id" class="btn btn-primary" data-dismiss="modal">Да, удалить</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>

                </div>

            </div>

        </div>

    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script src="js/dataTables.buttons.js"></script>
<script src="js/buttons.bootstrap.js"></script>
<script src="js/buttons.html5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<script type="application/javascript">

    $(document).on("ready", function () {

        spisok();
        modify();
        delete1();




    });
    var modify = function (){
        $("form").on("submit", function(e){

            e.preventDefault();
            var frm = $(this).serialize();
            console.log( frm);

            $.ajax({
                method: "POST",
                url: "insert_admin.php",
                data: frm


            }).done(function(info){

                var json_info = JSON.parse(info);
                display_message ( json_info );
                spisok();


            });




        });


    }
    var delete1 = function (){

        $("#delete_id").on("click",function (){
            var id = $("#ModalFormDeleteData #id").val(),
                option = $("#ModalFormDeleteData #option").val();

            $.ajax({
                method : "POST",
                url: "insert_admin.php",
                data: {"id" : id, "option": option}

            }).done( function(info){
                var json_info = JSON.parse( info);
                display_message ( json_info );
                spisok();

            });
        });

    }
    var display_message = function( info ) {
        var text = "", color = "";
        if (info.zamena == "ОК") {
            text = "<strong>OK!</strong> Все изменения сохранены!";
            color = "#379911";
        } else if (info.zamena == "ОШИБКА") {
            text = "<strong>ОШИБКА</strong>, запрос не был выполнен";
            color = "#C9302C";
        } else if (informacion.respuesta == "НЕТ ОПЦИИ") {
            text = "<strong>Внимание!</strong> Опция передачи данных не найдена";
            color = "#5b94c5";
        } else if (informacion.respuesta == "ДОБАВЛЕНО") {
            text = "<strong>Внимание!</strong> debe llenar todos los campos solicitados.";
            color = "#ddb11d";
        }

        $("#msgbox_head").html( text ).css({"color":color});
        $("#msgbox_head").fadeOut(5000, function(){
            $(this).html("");
            $(this).fadeIn(3000);
        });

    }
    var clear_data = function () {
        $("#option").val("add_user");
        $("#id").val("");
        $("#user_password").val("");
        $("#user_name").val("");
        $("#login").val("");
        $("#user_mail").val("");
        $("#administrator").val("");
        $("#koordinator").val("");
        $("#manager").val("");
        $("#tender").val("");
        $("#purchase").val("");
        $("#tender_got").val("");


    }
    var spisok = function () {

        $("#insert_form").slideUp("Slow");
        $("#table").slideDown("Slow");

        var table = $("#container").DataTable({


            //динамическое обновление колонок
            "ajax" : {
                "method" : "POST",
                "url" : "get_admin.php"
            },
            //заполняем колонки
            "columns" : [

                {"data"  :   "id"},
                {"data"  :   "user_name"},
                {"data"   :  "user_login"},
                {"data"  :   "user_mail"},
                {"data"  :   "admin"},
                {"data"  :   "koordinator"},
                {"data"  :   "manager"},
                {"data"  :   "tender"},
                {"data"  :   "purchase"},
                {"data"  :   "tend_got"},


                {"defaultContent" : "<button type = 'button' class='edit btn btn-primary btn-sm'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button> "},
                {"defaultContent" : "<button type = 'button' class='delete btn btn-danger btn-sm' data-toggle='modal' data-target='#modalDelete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>"}
            ],

            //язык
            "language" : {

                "processing": "Подождите...",
                "search": "Поиск:",
                "lengthMenu": "Показать _MENU_ записей",
                "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                "infoEmpty": "Записи с 0 до 0 из 0 записей",
                "infoFiltered": "(отфильтровано из _MAX_ записей)",
                "infoPostFix": "",
                "loadingRecords": "Загрузка записей...",
                "zeroRecords": "Записи отсутствуют.",
                "emptyTable": "В таблице отсутствуют данные",
                "paginate": {
                    "first": "Первая",
                    "previous": "Предыдущая",
                    "next": "Следующая",
                    "last": "Последняя"
                },

                "aria": {
                    "sortAscending": ": активировать для сортировки столбца по возрастанию",
                    "sortDescending": ": активировать для сортировки столбца по убыванию"
                }

            },
            //DOM для кнопок добавить и импортировать
            "dom" :  "<'row'<'form-inline' <'col-sm-offset-5'B>>>"
            +"<'row' <'form-inline' <'col-sm-1'f>>>"
            +"<rt>"
            +"<'row'<'form-inline'"
            +" <'col-sm-6 col-md-6 col-lg-6'l>"
            +"<'col-sm-6 col-md-6 col-lg-6'p>>>",//'Bfrtip',


            //инициализация кнопок Добавить и Импорт
            "buttons" : [



                {
                    className:'btn-success btn-sm',
                    "text" : "<i class='glyphicon glyphicon-plus'></i>",
                    "titleAttr" : "Добавление тендера",
                    "action" : function () {
                        add_new_tender();

                    }

                },
                {
                    className: 'btn-sm',
                    extend:    'copy',
                    text:      '<i class="glyphicon glyphicon-copy"></i>',
                    titleAttr: 'Copy to clipboard',


                },
                {
                    className: 'btncolumns btn btn-sm  btn-warning dropdown-toggle',
                    text:      '<i class="glyphicon glyphicon-cog"></i>',
                    "titleAttr" : "Выбор полей",


                },



            ],
            "destroy":true




        });


        edit_data("#container tbody", table);
        delete_data("#container tbody", table);
        $(".btncolumns").attr({'data-toggle':'modal', 'data-target':'#ModalColumns'});


    }
    var add_new_tender = function () {
        clear_data();
        $("#insert_form").slideDown("Slow");
        $("#table").slideUp("Slow");


    }
    var edit_data = function (tbody, table){
        $("#insert").val("Редактировать");

        $(tbody).on("click", "button.edit", function(){

            var data = table.row( $(this).parents("tr") ).data();
            $("#option").val("edit_user");
            $("#id").val(data.id);
            $("#user_name").val(data.user_name);
            $("#login").val(data.user_login);
            $("#user_mail").val(data.user_mail);
            $("#user_password").val("");
            $("#administrator").val(data.admin);
            $("#koordinator").val(data.koordinator);
            $("#manager").val(data.manager);
            $("#tender").val(data.tender);
            $("#purchase").val(data.purchase);
            $("#tender_got").val(data.tend_got);
            $("#insert_form").slideDown("Slow");
            $("#table").slideUp("Slow");



        });
    }
    var delete_data = function (tbody, table) {

        $(tbody).on("click", "button.delete", function () {

            var data = table.row($(this).parents("tr")).data();
            $("#ModalFormDeleteData #id").val(data.id);

            $("#ModalDelete").modal("show");


        });
    }


</script>



</body>
</html>