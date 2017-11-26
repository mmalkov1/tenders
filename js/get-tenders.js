 var spisok = function () {

            $("#insert_form").slideUp("Slow");
            $("#table").slideDown("Slow");

            var leftcol=$("#left").val();
            var rightcol=$("#right").val();
            var date_info = $('#input-info').serialize();
            //определение высоты экрана для отображения таблицы
            var height = '75vh';
            if ($(window).height()<=768) {
                height = '57vh';
                
            };
                         
            var table = $("#container").DataTable({


                //сохранение настроек таблицы после перезагрузки


           /*   "bStateSave" : true,
                "fnStateSave" :function(settings,data){
                    localStorage.setItem("dataTables_state", JSON.stringify(data));
                },
                "fnStateLoad": function(settings) {
                    return JSON.parse(localStorage.getItem("dataTables_state"));
                },*/
                //динамическое обновление колонок
                "ajax" : {
                    "method" : "POST",
                    "url" : "get.php",
                     "data":  function ( d ) {
                        d.date_0 = $('#date_0').val();
                        d.date_2 = $("#date_2").val();
                        d.filter = $("#filter").val();
                        d.option_filter = $("#option_filter").val();
                             },           
                },

                //заполняем колонки
                "columns" : [
                    {
                        "className":      'id-column',
                        "data": null,// null,
                        "render" : function(data, type, full, meta){
                        data ='<div class="col-md-12">' + full['id'] + '</div><button type = "button" class="edit btn btn-primary btn-xs col-md-6"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type = "button" class="delete btn btn-danger btn-xs col-md-6" data-toggle="modal" data-target="#modalDelete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button><div class="col-md-12 details-control"><a><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></div>';
                        return data
                        }


                    },
                    
                    {"data"  :   "date_og"},
                    {"data"  :   "date_add"},
                    {"data"  :   "area"},
                    {"data"  :   "number", "width" : "100px" },
                    {"data"  :   "link"},
                    {"data"  :   "zakazchik"},
                    {"data"  :   "okpo"},
                    {"data"  :   "product_group"},
                    {"data"  :   "redmet_torgov"},
                    {"data"  :   "sku"},
                    {"data"  :   "lpr"},
                    {"data"  :   "sum_zakaz"},
                    {"data"  :   "zatrati_tender"},
                    {"data"  :   "zatrati_dop"},
                    {"data"  :   "date_start"},
                    {"data"  :   "date_end"},
                    {"data"  :   "date_aukcion"},
                    {"data"  :   "purch_comp"},
                    {"data"  :   "purch_time"},
                    {"data"  :   "purch_note"},
                    {"data"  :   "alignment"},
                    {"data"  :   "manager"},
                    {"data"  :   "organization"},
                    {"data"  :   "dog_lob"},
                    {"data"  :   "cond_koord"},
                    {"data"  :   "law"},
                    {"data"  :   "tend_send"},
                    {"data"  :   "tend_got"},
                    {"data"  :   "tend_prep"},
                    {"data"  :   "date_send_purch"},
                    {"data"  :   "name_purch"},
                    {"data"  :   "date_got_purch"},
                    {"data"  :   "sum_per"},
                    {"data"  :   "sum_itog"},
                    {"data"  :   "sum_purch"},
                    {"data"  :   "date_app"},
                    {"data"  :   "result"},
                    {"data"  :   "couse"},
                    {"data"  :   "winner"},
                    {"data"  :   "sum_win"},
                    {"data"  :   "date_over"},


                   
                ],

                //ссылка на тендер
                "columnDefs": [

                    {
                    "targets": 5,

                    "render": function (data, type, full, meta) {
                        return '<a href="' + data + '">Ccылка</a>';
                    },



                },//обрезка длинных строк
                    {
                        "targets": [9,6,11],

                        "data": null,
                        "defaultContent": "Пусто",
                        "render": function (data, type, full, meta) {
                            return data !== null && data.length > 40 ?
                                '<span title="' + data + '">' + data.substr( 0, 38 ) + '...</span>' : data;
                        }
                    },
                    {
                        'targets': 37,
                        'createdCell': function (td, cellData, rowData, row, col) {
                            $(td).attr('id', 'result');

                        },


                    },
                    {
                        'targets': 21,
                        'createdCell': function (td, cellData, rowData, row, col) {
                            $(td).attr('id', 'align');

                        },

                    }
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
                "dom" :  "<'row'<'form-inline' <'col-sm-1 add-block'B>>>"
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




                ],//фиксация полей
               "destroy":true,
                "sScrollY": height,
                 "sScrollX": true,
               /* "sScrollXInner": "150%",
                "bScrollCollapse": true,*/
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],

                "fixedColumns": {

                    "iLeftColumns": leftcol,
                    "iRightColumns": rightcol,
                },

                'createdRow': function( row, data, dataIndex ) {
                    
                    if ($(row).children('#align').html()==="") {
                        $(row).addClass('blank');
                    };
                    if ($(row).children('#align').html()==="Не согласовано") {
                        $(row).addClass('NotAgreed');
                    };
                    if ($(row).children('#result').html()==="" && $(row).children('#align').html()==="Согласовано") {
                        $(row).addClass('Agreed');
                    };
                    if ($(row).children('#result').html()==="Не участвуем") {
                        $(row).addClass('NotParticipate');
                    };
                    if ($(row).children('#result').html()==="Переторг") {
                        $(row).addClass('Redevelopment');
                    };
                    if ($(row).children('#result').html()==="Проиграли") {
                        $(row).addClass('Lose');
                    };
                    if ($(row).children('#result').html()==="Выиграли") {
                        $(row).addClass('Win');
                    };
                    if ($(row).children('#result').html()==="Ожидание результата") {
                        $(row).addClass('Wait');
                    };
                    if ($(row).children('#result').html()==="Дисквалификация") {
                        $(row).addClass('Disqualification');
                    };
                },

            });

            edit_data("#container tbody", table);
            delete_data("#container tbody", table);
            $(".btncolumns").attr({'data-toggle':'modal', 'data-target':'#ModalColumns'});

            //дополнительное поле - расшифровка

            $('#container tbody').on('click', 'div.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );


                if ( row.child.isShown() ) {
                    row.child.hide();
                    tr.removeClass('shown');
                    $(tr).children("td").children(".details-control").html('<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>');

                }
                else {
                    row.child( format(row.data()) ).show();
                    //console.log(row.data());
                    tr.addClass('shown');
                    $(tr).children("td").children(".details-control").html('<i class="fa fa-chevron-circle-up" aria-hidden="true"></i>');
                }
            } );
            var  format = function  ( rowData ) {
                var div = $('<div/>')
                    .addClass( 'loading' )
                    .text( 'Загрузка...' );

                $.ajax( {
                    method: "POST",
                    url: 'get_row.php',
                    data: {
                        id: rowData.id
                    },
                    dataType: 'json',
                    success: function ( data ) {
                       // var info = JSON.parse(data);
                       console.log (data);
                        div
                            .html( "<table id='info_row"+rowData.id+"'><tr><td> Номер тендера в БД: </td><td>" + data[0]["number"] + "</td><td>Доп. предприятие</td><td>" + data[0]["organization"] + "</td></tr>" +
                            "<tr><td> ОКПО Заказчика: </td><td>" + data[0]["okpo"] + "</td><td> Сложность закупки: </td><td>" + data[0]["purch_comp"] + "</td></tr>" +
                            "<tr><td> Контактное лицо: </td><td> " + data[0]["lpr"] + "</td><td> Сроки запроса: </td><td>" + data[0]["purch_time"] + "</td></tr>" +
                            "<tr><td> Начальная дата подачи: </td><td> " + data[0]["date_start"] + "</td><td> В закупке от/до : </td><td>" + data[0]["date_send_purch"] + " / "+ data[0]["date_got_purch"]+"</td></tr>" +
                            "<tr><td> Группа товаров: </td><td> " + data[0]["product_group"] + "</td><td> Ответственный в закупке: </td><td>" + data[0]["name_purch"] + "</td></tr>"+
                            "<tr><td> Кол-во позиций: </td><td> " + data[0]["sku"] + "</td><td> Дата подачи: </td><td>" + data[0]["date_app"] + "</td></tr>" +
                            "<tr ><td> Сумма затрат: </td><td> " + data[0]["zatrati_tender"] + " + доп. затрат "+ data[0]["zatrati_dop"] + " </td>" +
                            "<td >Последние тендера</td><td class='last-tenders"+rowData.id+"'>");
                            for (i=1;i<=data.length-1;i++) {

                                if (data[i]["percent_itog"]==null) {
                                    data[i]["percent_itog"] = "0";
                                }
                                if (data[i]["percent_itog"]=="-100") {
                                    data[i]["percent_itog"] = "0";
                                }

                                switch (data[i]["result"]) {
                                    case 'Выиграли' :  $(".last-tenders"+rowData.id).append("<a href='"+data[i]["link"]+"' target='_blank'><div class='Win sm' title='"+data[i]["sum_zakaz"] +"'>"+data[i]['percent_itog']+"%</div></a>");
                                    break;
                                    case 'Ожидание результата' : $(".last-tenders"+rowData.id).append("<a href='"+data[i]["link"]+"' target='_blank'><div class='Wait sm'>"+data[i]['percent_itog']+"%</div></a>");
                                        break;
                                    case 'Не участвуем' : $(".last-tenders"+rowData.id).append("<a href='"+data[i]["link"]+"' target='_blank'><div class='NotParticipate sm'>"+data[i]['percent_itog']+"%</div></a>");
                                        break;
                                    case 'Проиграли' : $(".last-tenders"+rowData.id).append("<a href='"+data[i]["link"]+"' target='_blank'><div class='Lose sm'>"+data[i]['percent_itog']+"%</div></a>");
                                        break;
                                    case 'Переторг' : $(".last-tenders"+rowData.id).append("<a href='"+data[i]["link"]+"' target='_blank'><div class='Redevelopment sm'>"+data[i]['percent_itog']+"%</div></a>");
                                        break;    
                                    default : if (data[0]["okpo"]!=="") {$(".last-tenders"+rowData.id).append("<a href='"+data[i]["link"]+"' target='_blank'><div class='Agreed sm'>"+data[i]['percent_itog']+"%</div></a>");}
                                        break;
                                }


                            }
                            $("#info_row"+rowData.id).append("</td></tr></table>");
                           // .removeClass( 'loading' );
                    }
                } );

                return div;
            };

        }