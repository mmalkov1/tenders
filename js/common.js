//удаление строки тендера
    var delete1 = function (){

         $("#delete_id").on("click",function (){
            var id = $("#ModalFormDeleteData #id").val(),
                option = $("#ModalFormDeleteData #option").val();

            $.ajax({
                method : "POST",
                url: "insert.php",
                data: {"id" : id, "option": option}

            }).done( function(info){
                var json_info = JSON.parse( info);
                display_message ( json_info );
                spisok();

            });
         });

        }
//отправка письма уведомления о новом тендере пользователю

    var sendMail = function () {


        $("#send").on("click", function () {

            var modal_data = $('#insert_form').serialize();

            $.ajax ({
               method: "POST",
                type: "JSON",
               url: "../sendmail.php",
               data: modal_data,
               success: function (data) {
                 var info = JSON.parse(data);
                 console.log(data);
                 if (info["results"]["status"] == "OK"){
                     alert ("Сообщение отправлено на почту " + info["results"]["locator"])

                 } else {

                     alert ("Сообщение не отправлено [" + info["results"]["status"] + "]")
                 }

               }



           })

        })

    }

 
    var LoginRegistration = function(){
    // открытие/закрытие левого меню
    	$(".fa-bars").on("click",function(){
    		$(".left-menu").toggleClass("left-menu-active");
    		$(document).mouseup(function (e){
    		var div = $(".left-menu-active"); 
			if (!div.is(e.target) && div.has(e.target).length === 0) { 
			div.removeClass("left-menu-active");
			} 
			});
    	});
   //ротация форм логина  и регистрации
    	$("#registration").on("click",function(){
    		$("#login").slideToggle();
    		$("#signup").slideToggle();
    		$(".label-login").html("<span style='color: indianred'>Регистрация</span>");

    	})
    	$("#back-to-login").on("click",function(){
    		$("#signup").slideToggle();
    		$("#login").slideToggle();
    		$(".label-login").html("Вход");
    		
    	})

    }
    //залогиниваем
    var login = function (){
    	$(".login-btn").on("click",function(){
    		console.log("Нажал");
    		var login_data = $(".login-form").serialize();
    		console.log(login_data);
    		$.ajax ({
    			method: "POST",
    			url: "login.php",
    			data: login_data,
    			success: function (data) {
    				var info = JSON.parse(data);
    				
    				if (info == "Вы авторизованы") {
    					location.reload();
    				} else {
    					$(".login-form").append("<label class='message_login'>"+info+"</label>");
    					$(".message_login").fadeOut(5000);	
    				}
    			}
    		})
    	})
    }
    // регистрация
    var signup = function (){
    	$(".signup-btn").on("click",function(){
    		console.log("Нажал");
    		var signup_data = $(".signup-form").serialize();
    		console.log(signup_data);
    		$.ajax ({
    			method: "POST",
    			url: "login.php",
    			data: signup_data,
    			success: function (data) {
    				var info = JSON.parse(data);
    				console.log(info);
    				if (info == "Зарегистрирован") {
    					location.reload();
    				} else {
    					$(".signup-form").append("<label class='message_login'>"+info+"</label>");
    					$(".message_login").fadeOut(5000);	
    				}
    			}
    		})
    	})
    }

    //Присвоение имен для чекбоксов в настройках с целью сохранения персональніх настроек
    var checkboxName = function () {
        $(".modal-body input").each(function(){
            var id = $(this).attr('id');
            $(this).attr("name",id);
        })

    }

    //сохранение настроек пользователя
    var option_save = function () {
        $("#option_save").on('click', function () {
           var modal_data = $('#Modal').serialize();
           console.log(modal_data);
            $.ajax ({
                method : "POST",
                url : "save_options.php",
                data : modal_data,
                success : function(data){
                    $("#msgbox_head").html(data).css({"color":"green"});
                    $("#msgbox_head").fadeOut(3000, function(){
                        $(this).html("");
                        $(this).fadeIn(1000);
                    });
                }
            })
        })
    }
    // фильтр дата

    var filter = function(){
    	
    	 $('#date_0, #date_2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    	$("#submit_filter").off("click", function(){
    		$("#filter").val("filter");
    		spisok();
    	});
    	$("#submit_filter").on("click", function(){
    		$("#filter").val("filter");
    		spisok();
    	});
    	$("#filter_clear").off("click", function(){
    		$("#filter").val("");
    		spisok();
    	})
    	$("#filter_clear").on("click", function(){
    		$("#filter").val("");
    		spisok();
    	})
    }

    //загрузка личных настроек пользователя

    var load_options = function () {
        var modal_data = $('#Modal').serialize();
        $.ajax ({
            method : "POST",
            url: "get_options.php",
            data: modal_data,
            success: function (data) {
                var option = JSON.parse(data);

                var table = $('#container').DataTable();
                for (var i = 0; i <42; i++) {
                    if (option[i] == "on") {
                        $("#check"+i).prop("checked",true);
                        table.columns(i).visible( true );
                    }
                    else {
                        $("#check"+i).prop("checked",false)
                        table.columns(i).visible( false );

                    }

                };

                $("#left").prop("value",option[42]);
                $("#right").prop("value",option[43]);
               
                //spisok();
            }
        })

    }

    //редактирование ячейки

    var click = function () {
        $("#container").on("click","td",function(e) {
            var t = e.target || e.srcElement;
            var elm_name = t.tagName.toLowerCase();
            if(elm_name == 'input')	{return false;}
            var val = $(this).html();
            var code = "<input type='text' id='edit_cell' value='"+val+"'/>";
            $(this).empty().append(code);
            $('#edit_cell').focus();
            $('#edit_cell').blur(function()	{	//устанавливаем обработчик
                var val = $(this).val();	//получаем то, что в поле находится
                //находим ячейку, опустошаем, вставляем значение из поля
                $(this).parent().empty().html(val);
            });

        })
    }


    //добавление инпутов для фильтров полей
    var i = 0;
    var addInputSearch = function () {

        $(".head-table").children("th").each(function () {
            var id = $(this).attr('id');
         
            $("#search"+id).one('click',function () {
            	i++;
                $("#container_filter").append(
                    "<div class='search_col' name='"+i+"'><div class='search_col_label'>"+ $("#head").children("#"+id).text() +"</div><input type='search' class='form-control input-sm' id='text_search"+id+
                    "' data-column='"+id+"' placeholder='Поиск...'/><i class='fa fa-times-circle' aria-hidden='true'></i></div>");
                 $('#text_search1').datetimepicker({
          		  format: 'YYYY-MM-DD'
       			 });
                $("#container_filter label").hide();
                //закрытие поля по крестику
                $(".fa-times-circle").on('click',function () {
            		
            		$(this).parent("div").hide();
            		if ($(this).parent("div").attr("name")=="1") {
            			$("#container_filter label").show();
            			i = 0;	
            		}
        		});

        		//живой поиск
                $('#text_search'+id).on('click', function () {

                    filterColumn(id);

                } );
            })

        })
        

    }
    
    //фильтр отдельного поля

    var filterColumn = function (i) {

        $("#container").DataTable().column(i).search(
            $("#text_search"+i).val()

        ).draw();

    };

       
        //отображение/скрытие столбцов таблицы при загрузке
        var visibleOnLoad = function(){
        	 var table = $('#container').DataTable();
                for (var i = 0; i < 42; i++) {
                	if ($("#check"+i).attr("checked")=="checked"){
                		table.columns(i).visible( true );
                	} else {
                    // the checkbox is now no longer checked
                    table.columns(i).visible( false );
                	}

                }
            checkName();    
        }
           //отображение в checkbox'ах видимых столбцов
        var loop = function ()
        {
            for (var i = 0; i < 42; i++) {
                visible(i);
            }
        }   
        //название для чекбоксов
        var checkName = function () {
        	$('#tab21 ul li input').each(function(){
        		id = $(this).attr("number-checkbox");
        		name = $('table #head #'+id+" div:eq(0)").html();
        		$(this).parent("li").append("<label>"+name+"</label>");
        	})
        }
        //функция отображения/скрытия столбцов таблицы по изменению состояния чекбокса
        var visible = function(id){

        	
            $('#check'+id).change(function() {
                var table = $('#container').DataTable();
                if (this.checked) {
                    // the checkbox is now checked

                     table.columns(id).visible( true );
                } else {
                    // the checkbox is now no longer checked
                    table.columns(id).visible( false );
                }
            });

        }
        
        // парсинг информации о тендере
 var parse = function(){
            $("#parse").on("click", function(){
                var link = $("#link").val();

                if (link.length > 0) {
                    $.ajax({
                        method: "POST",
                        url: "parser.php",
                        data: {"link": link},
                        dataType: "json",
                        success: function (data) {
                            $("#name").val(data[0]["name"]);
                            $("#area").val(data[0]["area"]);
                            $("#okpo").val(data[0]["okpo"]);
                            $("#date_end").val(data[0]["date_end"]);
                            $("#date_aukcion").val(data[0]["date_aukcion"]);
                            $("#sum_zakaz").val(data[0]["sum_tender"]);
                            $("#redmet_torgov").val(data[0]["redmet_torgov"]);
                            $("#zatrati_tender").val(data[0]["sum_zatrat"]);
                            $("#lpr").val(data[0]["lpr"]);
                            $("#number").val(data[0]["num"]);
                            $("#date_1").val(data[0]["date_add"]);
                            $("#date").val(data[0]["date_og"]);
                            $("#date_start").val(data[0]["date_start"]);

                        }
                    })
                } else {
                    alert ("Нет ссылки");
                  }
            })

        }
// редактирование информации о тендере
        var modify = function (){
            $(".edit-row").on("submit", function(e){

                e.preventDefault();
                var frm = $(this).serialize();
                

                $.ajax({
                    method: "POST",
                    url: "insert.php",
                    data: frm


                }).done(function(info){

                    var json_info = JSON.parse(info);
                    display_message ( json_info );
             
                });
				spisok();
            });

            
        }
        //информационное окно Callback сохранения в БД
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

// очистка формы для добавления нового тендера
        var clear_data = function () {
	        $("#option").val("add");
	        $("#date_1").val ("");
	        $("#date").val ("");
	        $("#area").val ("Smarttender");
	        $("#link").val ("");
	        $("#number").val ("");
	        $("#okpo").val("");
	        $("#product_group").val("");
	        $("#redmet_torgov").val ("");
	        $("#sku").val("");
	        $("#lpr"). val("");
	        $("#sum_zakaz").val("");
	        $("#zatrati_tender").val("");
	        $("#zatrati_dop").val("");
	        $("#date_start").val("");
	        $("#date_end").val("");
	        $("#date_aukcion").val("");
	        $("#conditions").val("");
	        $("#name").val("");
	        $("#purch_comp").val("");
            $("#purch_time").val("");
            $("#purch_cond").val("");
            $("#alignment").val("");
            $("#manager").val("");
            $("#dog_lob").val("");
            $("#organization").val("");
            $("#cond_koord").val("");
            $("#tender").val("");
            $("#tend_got").val("");
            $("#koordinator").val("");
            $("#date_send_purch").val("");
            $("#purchase").val("");
            $("#date_got_purch").val("");
            $("#sum_per").val("");
            $("#sum_itog").val("");
            $("#sum_purch").val("");
            $("#date_app").val("");
            $("#result").val(0);
            $("#couse").val("");
            $("#winner").val("");
            $("#sum_win").val("");
            $("#date_over").val("");
            $("#accent").val("");
            $("#insert").val("Вставить");

    }
    // вызов модального окна для добавления нового тендера
    var add_new_tender = function () {
            clear_data();
            $("#insert_form").slideDown("Slow");
            $("#table").slideUp("Slow");


        }
    // вызов модального окна для редактирование существующего тендера

     var edit_data = function (tbody, table){
            $("#insert").val("Редактировать");

            $(tbody).on("click", "button.edit", function(){

                var data = table.row( $(this).parents("tr") ).data();

                $("#option").val("edit");
                $("#id").val(data.id);
                $("#date_1").val (data.date_add);
                $("#date").val (data.date_og);
                $("#area").val (data.area);
                $("#link").val (data.link);
                $("#number").val (data.number);
                $("#okpo").val(data.okpo);
                $("#product_group").val(data.product_group);
                $("#redmet_torgov").val (data.redmet_torgov);
                $("#sku").val(data.sku);
                $("#lpr"). val(data.lpr);
                $("#sum_zakaz").val(data.sum_zakaz);
                $("#zatrati_tender").val(data.zatrati_tender);
                $("#zatrati_dop").val(data.zatrati_dop);
                $("#date_start").val(data.date_start);
                $("#date_end").val(data.date_end);
                $("#date_aukcion").val(data.date_aukcion);
                $("#conditions").val(data.conditions);
                $("#purch_comp").val(data.purch_comp);
                $("#purch_time").val(data.purch_time);
                $("#purch_cond").val(data.purch_note);
                $("#alignment").val(data.alignment);
                $("#manager").val(data.manager);
                $("#dog_lob").val(data.dog_lob);
                $("#organization").val(data.organization);
                $("#cond_koord").val(data.cond_koord);
                $("#tender").val(data.tend_send);
                $("#tend_got").val(data.tend_got);
                $("#koordinator").val(data.tend_prep);
                $("#date_send_purch").val(data.date_send_purch);
                $("#purchase").val(data.name_purch);
                $("#date_got_purch").val(data.date_got_purch);
                $("#sum_per").val(data.sum_per);
                $("#sum_itog").val(data.sum_itog);
                $("#sum_purch").val(data.sum_purch);
                $("#date_app").val(data.date_app);
                $("#result1").val(data.result);
                $("#couse").val(data.couse);
                $("#winner").val(data.winner);
                $("#sum_win").val(data.sum_win);
                $("#date_over").val(data.date_over);
                $("#name").val(data.zakazchik);
                $("#accent").val(data.accent);


                $("#insert_form").slideDown("Slow");
                $("#table").slideUp("Slow");



            });
        }
        //вызов модального окна для удаления тендера

         var delete_data = function (tbody, table) {

                $(tbody).on("click", "button.delete", function () {

                    var data = table.row($(this).parents("tr")).data();
                    $("#ModalFormDeleteData #id").val(data.id);

                    $("#ModalDelete").modal("show");


                });
            }
  $(function () {


        $(".btncolumns").attr({'data-toggle':'modal', 'data-target':'#ModalColumns'});
        $('#date_aukcion, #date_start, #date_end, #date_send_purch, #date_got_purch').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'

        });
        $('#date, #date_1, #date_app, #date_over, #text_search1, #date_0, #date_2').datetimepicker({
            format: 'YYYY-MM-DD'

        });
    });
    $("#left").on("change", function(){

        spisok();
    });
    $("#right").on("change", function(){

        spisok();
    })
//закрытие модального окна

$("#spisok").on("click", function (){

        spisok();

    });