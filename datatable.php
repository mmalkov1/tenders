<?php

require 'GetDataForm.php';

?>

<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title></title>
    
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>-->
    <link rel="stylesheet" href="https://bootswatch.com/3/paper/bootstrap.min.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    <!--<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css" /> -->
    <!--<link rel="stylesheet" href="https://bootswatch.com/solar/bootstrap.min.css" type="text/css"/>-->
    
    <link rel="stylesheet" href="css/table.css" type="text/css"/>



</head>
<body>
<div id="msgbox_head"></div>

<div class="left-menu">
    
     <?php  if (!isset($_SESSION['logged_user'])){ ?> 
     <div class="login-col">
        <div class="label-login">Вход</div>
     </div>   
     <div id="login">
        <form class="login-form" name='form-login'>
            <input type="text" class="form-control" id="user" name="user" placeholder="Логин" value="<?php echo @$data['user']?>">
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Пароль" >
            <input type="hidden" name ="do_login" value="login">
            <input type="button" class="login-btn btn btn-success" name ="do_login" value="Вход">
            <a id="registration" href="#">Регистрация</a>

        </form>
    </div>
    <div id="signup" style="display: none">
      <form class="signup-form" name='form-login'>
        <span class="fontawesome-user"></span>
          <input type="text" class="form-control" id="user" name="user" placeholder="Введите логин" value="<?php echo @$data['user']?>">
          <span class="fontawesome-envelope"></span>
          <input type="text" class="form-control" id="u_name" name="u_name" placeholder="Введите Ф.И.О." value="<?php echo @$data['u_name']?>">
          <span class="fontawesome-envelope"></span>
          <input type="text" class="form-control"  id="email" name="email" placeholder="Введите e-mail" value="<?php echo @$data['email']?>">
          <span class="fontawesome-lock"></span>
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Введите свой пароль" >
          <span class="fontawesome-lock"></span>
          <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Введите пароль еще раз">
          <input type="hidden" name ="do_login" value="signup">
          <input type="button" class="signup-btn btn btn-danger" name ="do_signup" value="Регистрация">
          <a id="back-to-login" href="#">Войти</a>
      </form>
    </div>
    <?php } else { $user_name = explode(" ", $_SESSION['logged_user']->user_name);?>
        <div class="login-col">
            <div class="label-login">Вы вошли как:</div>
        </div>  
        <div class="user-name"><span class="firstname"><?php echo $user_name[1]; ?></span><span class="surname"><?php echo $user_name[0]; ?></span>
        <a class="login btncolumns" href="#"><i class="fa fa-cog fa-spin" aria-hidden="true" id="cog"></i></a>
        <?php if ($_SESSION['logged_user'] && $admin == 1) { ?>
        <a class="adminpanel" href="/admin.php" target="_blank">Admin</a>
        <?php } ?>
        </div>
        <a class="logout" href="/logout.php"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i> Выйти </a>
    <?php }?>
     <div >
         <div id="input-info" class="date-col">
            <span>Фильтр по дате</span>
            <input type="text" id="date_0" name="date_0" class="form-control" placeholder="Дата начала" />
            <input type="text" id="date_2" name="date_2" class="form-control" placeholder="Дата окончания" />
            <select class="form-control" name="option_filter" id="option_filter">
                <option value="date_add">По дате добавления</option>
                <option value="date_og">По дате публикации</option>
                <option value="date_end">По дате окончания</option>
                <option value="date_aukcion">По дате аукциона</option>
                <option value="date_over">По дате завершения</option>
            </select>
            <input type="hidden" name="filter" id="filter"/>
            <input type="button" class="btn btn-success" name="date_filter" id="submit_filter" value="Фильтр" />
            <input type="button" class="btn btn-default" name="filter_clear" id="filter_clear" Value="Сбросить"/>
        </div>
    </div>

    <i class="fa fa-bars" aria-hidden="true"></i>

</div>    

<div class="content">
    <?php
if (!isset($_SESSION['logged_user'])) {
    if ($_COOKIE['id'])
    {

        $user = R::findOne('users', 'id = ?',array($_COOKIE['id']));
        $_SESSION['logged_user'] = $user;
    }
}

if (isset($_SESSION['logged_user'])){

   
    $name = $_SESSION['logged_user']->user_name;
    $id = $_SESSION['logged_user']->id;

    
}

?>
    <form id="Modal" action="/save_options.php" method="POST" >

        <div class="modal fade" id="ModalColumns" tabindex="-1" role="dialog"
             aria-labelledby="ModalHeader">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ModalHeader">Структура таблицы</h4>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab21" data-toggle="tab">Поля #1</a></li>
                            <li><a href="#tab22" data-toggle="tab">Поля #2</a></li>
                            <li><a href="#tab23" data-toggle="tab">Профиль</a></li>
                        </ul>


                    </div>

                    <div class="modal-body" >
                        <div class="tab-content">
                            <div id="tab21" class="form-group tab-pane active">
                                <label>Закрепить поля</label><br>
                                <label  >Слева:  </label><input   id="left" name="left" ><?php echo $leftcol ?></input>
                                <label>Справа:  </label><input id="right" name="right" ><?php echo $rightcol ?></input><br>
                                <table>
                                    <tr>
                                        <td>Общие</td>
                                    </tr>
                                    <tr>
                                        <ul >
                                            <?php echo $options ?>
                                           <!--  <td class="col-sm-6">
                                            <li  style="display: none;"><input type="checkbox" id="check-1" /><label>None</label></li>
                                            <li><input type="checkbox" id="check0"/><label>Номер п/п</label></li>
                                            <li><input type="checkbox" id="check1"/><label>Дата оголошення</label> </li>
                                            <li><input type="checkbox" id="check2"/><label>Дата добавления</label></li>
                                            <li><input type="checkbox" id="check3"/><label>Площадка</label></li>
                                            <li><input type="checkbox" id="check4"/><label>№ тендера</label></li>
                                            <li><input type="checkbox" id="check5"/><label>Ссылка на тендер</label> </li>
                                            <li> <input type="checkbox" id="check6"/><label>Заказчик</label> </li>
                                            <li><input type="checkbox" id="check7"/><label>ОКПО</label> </li>
                                            <li><input type="checkbox" id="check8"/><label>Группа товаров</label> </li>
                                            <li><input type="checkbox" id="check9"/><label>Предмет торгов</label> </li>
                                            <li><input type="checkbox" id="check10"/><label>SKU</label> </li>
                                            <li><input type="checkbox" id="check11"/><label>Контактное лицо</label> </li>
                                            <li><input type="checkbox" id="check12"/><label>Сумма оголошення</label> </li>
                                            <li><input type="checkbox" id="check13"/><label>Сумма затрат</label> </li>
                                            <li><input type="checkbox" id="check14"/><label>Доп. затраты </label> </li>
                                            <li><input type="checkbox" id="check15"/><label>Начальная дата подачи</label></li>
                                            <li><input type="checkbox" id="check16"/><label>Конечная дата подачи</label></li>
                                            <li><input type="checkbox" id="check17"/><label>Дата аукциона</label></li>
                                            <li><input type="checkbox" id="check18"/><label>Сложность закупки</label></li>  
                                            <li> <input type="checkbox" id="check19"/><label>Сроки выполнения запроса</label><br></li>
                                            <li><input type="checkbox" id="check20"/><label>Примечание закупки</label><br></li>
                                            </td><td class="col-sm-6">
                                            <li> <input type="checkbox" id="check21"/><label>Согласование менеджера</label><br></li>
                                            <li><input type="checkbox" id="check22"/><label>Менеджер</label><br></li>
                                            <li><input type="checkbox" id="check23"/><label>Доп. предприятие</label><br></li>
                                            <li> <input type="checkbox" id="check24"/><label>Дог. / Лоб.</label><br></li>
                                            <li><input type="checkbox" id="check25"/><label>Прим. для координатора</label><br></li>
                                            <li> <input type="checkbox" id="check26"/><label>Юр. департамент</label><br></li>
                                            <li><input type="checkbox" id="check27"/><label>Тендер отправил</label><br></li>
                                            <li><input type="checkbox" id="check28"/><label>Тендер получил</label><br></li>
                                            <li> <input type="checkbox" id="check29"/><label>Предложение подготовил</label><br></li>
                                            <li><input type="checkbox" id="check30"/><label>Дата отпр. запроса в закупку</label><br></li>
                                            <li> <input type="checkbox" id="check31"/><label>Ответственный в закупке</label><br></li>
                                            <li><input type="checkbox" id="check32"/><label>Дата ответа от закупки</label><br></li>
                                            <li><input type="checkbox" id="check33"/><label>Первичная сумма предложения</label><br></li>
                                            <li> <input type="checkbox" id="check34"/><label>Итоговая сумма</label><br></li>
                                            <li><input type="checkbox" id="check35"/><label>Сумма закупки</label><br></li>
                                            <li> <input type="checkbox" id="check36"/><label>Дата подготовки предложения</label><br></li>
                                            <li><input type="checkbox" id="check37"/><label>Результат</label><br></li>
                                            <li><input type="checkbox" id="check38"/><label>Причина проигрыша</label><br></li>
                                            <li> <input type="checkbox" id="check39"/><label>Победитель</label><br></li>
                                            <li><input type="checkbox" id="check40"/><label>Сумма победителя</label><br></li>
                                            <li> <input type="checkbox" id="check41"/><label>Дата окончания</label><br></li>                      
                                            </td> -->
                                        </ul>
                                    </tr>

                                </table>

                            </div>
                            <div id="tab22" class="form-group tab-pane">
                                <table>
                                  
                                </table>
                            </div>
                            <div id="tab23" class="form-group tab-pane">
                                
                            </div>

                        </div>

                        <input type="hidden" name="userId" value="<?php echo $id ?>"/>
                        <button type="submit" id="option_save" class="btn btn-success" name="submit" data-dismiss="modal">Сохранить</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>


                    </div>

                    <div class="modal-footer">



                    </div>

                </div>

            </div>

        </div>
    </form>
   
    <div id="table">

        <table id = "container" class = "table" style="font-size: 12px" >

            <thead>
                    <tr id="head"  class="head-table">

                        <th id="0"><div class="col-md-12 column_name">Номер п/п</div><div  id = 'search0' class='col-md-12 search-column glyphicon glyphicon-search'></></th>
                        <th id="1"><div class="col-md-12 column_name" >Дата оголошення </div><div id="search1" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="2"><div class="col-md-12 column_name" >Дата занесения в таблицу</div><div id="search2" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="3"><div class="col-md-12 column_name" >Площадка</div><div id="search3" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="4"><div class="col-md-12 column_name" >№ тендера</div><div id="search4" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="5"><div class="col-md-12 column_name" >Ссылка на тендер</div><div id="search5" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="6"><div class="col-md-12 column_name" >Заказчик</div><div id="search6" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="7"><div class="col-md-12 column_name" >ОКПО</div><div id="search7" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="8"><div class="col-md-12 column_name" >Группа товаров</div><div id="search8" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="9"><div class="col-md-12 column_name" >Предмет торгов</div><div id="search9" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="10"><div class="col-md-12 column_name">SKU</div><div id="search10" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="11"><div class="col-md-12 column_name">Контактное лицо</div><div id="search11" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="12"><div class="col-md-12 column_name" >Сумма оголошеня</div><div id="search12" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="13"><div class=" col-md-12 column_name">Сумма затрат</div><div id="search13" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="14"><div class="col-md-12 column_name">Доп.затраты</div><div id="search14" class="col-md-12 search-column glyphicon glyphicon-search"></div></th>
                        <th id="15">Начальная дата подачи</th>
                        <th id="16">Конечная дата подачи</th>
                        <th id="17">Дата аукциона</th>
                        <th id="18">Сложность закупки</th>
                        <th id="19">Сроки выполенения запроса</th>
                        <th id="20">Согласование менеджера</th>
                        <th id="21">Примечание закупки</th>
                        <th id="22">Менеджер</th>
                        <th id="23">Доп. предприятие</th>
                        <th id="24">Договорной/Лобовой</th>
                        <th id="25">Примечание для координатора</th>
                        <th id="26">Юридический департамент</th>
                        <th id="27">Тендер отправил</th>
                        <th id="28">Тендер получил</th>
                        <th id="29">Предложение подготовил</th>
                        <th id="30">Дата отпр. запр. в закупку</th>
                        <th id="31">Ответственный в закупке</th>
                        <th id="32">Дата ответа от закупки</th>
                        <th id="33">Первичная сумма предложения</th>
                        <th id="34">Итоговая сумма предложения</th>
                        <th id="35">Сумма закупки</th>
                        <th id="36">Дата подготовки предложения</th>
                        <th id="37">Результат</th>
                        <th id="38">Причина проигрыша</th>
                        <th id="44">Победитель</th>
                        <th id="39">Сумма победителя</th>
                        <th id="40">Дата окончания</th>
            </tr>

            </thead>


        </table>
    </div>
   <?php  if (isset($_SESSION['logged_user'])) { ?>
    <div style="width: 80%; padding-left: 10%">
                        <form method="post" class="form-horizontal edit-row" id="insert_form" style="display: none" >
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Общие</a></li>
                                <li><a href="#tab2" data-toggle="tab">Инфо о тендере</a></li>
                                <li><a href="#tab3" data-toggle="tab">Координатор</a></li>

                            </ul>
                            <div class="tab-content">
                              <div id="tab1" class="form-group tab-pane active">
                                <label class="control-label col-lg-2">Дата &nbsp; оголошення</label>
                                <div class="col-lg-4" >
                                     <input name="date" id="date" class="form-control"></input>

                                </div>
                                <label class="control-label col-lg-2">Дата &nbsp;внесения </label>
                                <div class="col-lg-4">
                                    <input name="date_1" id="date_1" class="form-control"></input>
                                </div>
                                <label class="control-label col-lg-2">Номер тендера </label>
                                <div class="col-lg-4">
                                    <input name="number" id="number" class="form-control"></input>
                                </div>
                                <label class="control-label col-lg-2">Площадка</label>
                                <div class="col-lg-4 ">
                                    <select name="area" id="area" class="getdata form-control dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span>
                                        <option value=""></option>
                                        <?php echo $area ?>
                                    </select>
                                </div>
                                <br/><br/>
                                <label class="control-label col-lg-2">Ссылка</label>
                                <div class="col-lg-4">
                                    <input name="link" id="link" class="form-control"></input>
                                </div>
                                <label class="control-label col-lg-2">ОКПО</label>
                                <div class="col-lg-4">
                                <input name="okpo" id="okpo" class="form-control"></input>
                                </div>
                                <br/><br/>
                                <label class="control-label col-lg-2">Название заказчика</label>
                                <div class="col-lg-10">
                                <textarea rows="2" cols="1" class="form-control" name="name" id="name"></textarea>
                                </div>
                                <label class="control-label col-lg-2">Группа товара</label>
                                <div class="col-lg-3">
                                <select name="product_group" id="product_group" class="getdata form-control">
                                    <option value=""></option>
                                    <?php echo $product_group ?>
                                </select>
                                </div>
                                <label class="control-label col-lg-2">Предмет торгов</label>
                                <div class="col-lg-3">
                                <input name="redmet_torgov" id="redmet_torgov" class="form-control"></input>
                                </div>
                                <div class="col-lg-2">
                                <input name="sku" id="sku" class="form-control"></input>
                                </div>
                                <label class="control-label col-lg-2">Контакты</label>
                                <div class="col-lg-4">
                                <input name="lpr" id="lpr" class="form-control"></input>
                                </div>
                                <label class="control-label col-lg-2" id="lgall">Сумма оголошення</label>
                                <div class="col-lg-4">
                                <input name="sum_zakaz" id="sum_zakaz" class="form-control"></input>
                                </div>
                                      <label class="control-label col-lg-12"></label>
                                <label class="control-label col-lg-2" id="lgall">Сумма затрат</label>
                                <div class="col-lg-4">
                                <input name="zatrati_tender" id="zatrati_tender" class="form-control"></input>
                                </div>
                                <label class="control-label col-lg-2" id="lgall">Доп затраты</label>
                                <div class="col-lg-4">
                                <input name="zatrati_dop" id="zatrati_dop" class="form-control"></input>
                                </div>
                                <label class="control-label col-lg-2">Начало приема заявок</label>
                                <div class="col-lg-4">
                                <input name="date_start" id="date_start" class="form-control"></input>
                                </div>
                                <label class="control-label col-lg-2">Окончание приема заявок</label>
                                <div class="col-lg-4">
                                <input name="date_end" id="date_end" class="form-control"></input>
                                </div>
                                <label class="control-label col-lg-8">Дата аукциона</label>
                                <div class="col-lg-4">
                                     <input name="date_aukcion" id="date_aukcion" class="form-control"></input>
                                </div>
                                <br/><br/><br/><br/><br/>
                                <label class="control-label col-lg-2">Специальные ком. условия</label>
                                <div class="col-lg-10">
                                <textarea rows="2" cols="1" class="form-control" name="conditions" id="conditions"></textarea>
                                </div>
                            </div>
                                  <div id="tab2" class="form-group tab-pane" >
                                      <label class="control-label col-lg-2">Сложность закупки</label>
                                      <div class="col-lg-2" >
                                          <select name="purch_comp" id="purch_comp" class="form-control dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Сложность закупки <span class="caret"></span>
                                              <option value=""></option>
                                              <option value="Легкий">Легкий</option>
                                              <option value="Средний">Средний</option>
                                              <option value="Сложный">Тяжелый</option>
                                          </select>

                                      </div>
                                      <label class="control-label col-lg-2">Сроки выполнения запроса</label>
                                      <div class="col-lg-2" >
                                          <input name="purch_time" id="purch_time" class="form-control"></input>

                                      </div>
                                      <label class="control-label col-lg-2">Количество заказных позиций</label>
                                      <div class="col-lg-2" >
                                          <input name="purch_cond" id="purch_cond" class="form-control"></input>
                                      </div>
                                      <label class="control-label col-lg-12"></label>
                                      <label class="control-label col-lg-2">Согласование</label>
                                      <div class="col-lg-2" >
                                          <select name="alignment" id="alignment" class="form-control dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                              <option value=""></option>
                                              <option value="Согласовано">Согласовано</option>
                                              <option value="Не согласовано">Не согласовано</option>
                                          </select>
                                      </div>

                                      <label class="control-label col-lg-2">Менеджер</label>
                                      <div class="col-lg-2" >
                                          <select name="manager" id="manager" class="getdata form-control dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span>
                                                    <option value=""></option>
                                                    <?php echo $manager?>
                                          </select>
                                      </div>
                                      <label class="control-label col-lg-2">Договоренность</label>
                                      <div class="col-lg-2" >
                                          <select name="dog_lob" id="dog_lob" class="form-control dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span>
                                              <option value=""></option>
                                              <option value="Договорной">Договорной</option>
                                              <option value="Лобовой">Лобовой</option>
                                          </select>
                                      </div>
                                      <label class="control-label col-lg-2">Доп. предприятие</label>
                                      <div class="col-lg-4" >
                                          <select name="organization" id="organization" class="getdata form-control dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span>
                                              <option value=""></option>
                                              <?php echo $organization ?>
                                          </select>
                                      </div>
                                      
                                      <label class="control-label col-lg-2">Инфо координатора</label>
                                      <div class="col-lg-4">
                                          <textarea rows="2" cols="1" class="form-control" name="cond_koord" id="cond_koord"></textarea>
                                      </div>
                                      <label class="control-label col-lg-2">Тендер отправил</label>
                                      <div class="col-lg-2" >
                                          <select name="tender" id="tender" class="getdata form-control"  role="button" aria-expanded="false"><span class="caret"></span>
                                              <option value=""></option>
                                              <?php echo $tend ?>
                                          </select>
                                      </div>
                                      <label class="control-label col-lg-2">Тендер получил</label>
                                      <div class="col-lg-2" >
                                          <select name="tend_got" id="tend_got" class="getdata form-control"  role="button" aria-expanded="false" ><span class="caret"></span>
                                              <option value=""></option>
                                              <?php echo $tend_got ?>
                                          </select>
                                      </div>
                                      <label class="control-label col-lg-2">Тендер подготовил</label>
                                      <div class="col-lg-2" >
                                          <select name="koordinator" id="koordinator" class="getdata form-control"  role="button" aria-expanded="false" ><span class="caret"></span>
                                              <!--<option value="" id="0"></option>-->
                                              <option value=''></option>
                                              <?php echo $koordinator ?>;
                                              </select>
                                      </div>

                                  </div>
                                  <div id="tab3" class="form-group tab-pane">
                                      <label class="control-label col-lg-2">Дата отправки запроса в закупку</label>
                                      <div class="col-lg-2">
                                          <input name="date_send_purch" id="date_send_purch" class="form-control"></input>
                                      </div>
                                      <label class="control-label col-lg-2">Ответственный в закупке</label>
                                      <div class="col-lg-2" >
                                          <select name="purchase" id="purchase" class="getdata form-control"  role="button" aria-expanded="false"><span class="caret"></span>
                                              <option value=""></option>
                                              <?php echo $purchase?>
                                          </select>
                                      </div>

                                      <label class="control-label col-lg-2">Дата ответа от закупки</label>
                                      <div class="col-lg-2">
                                          <input name="date_got_purch" id="date_got_purch" class="form-control"></input>
                                      </div>
                                      <label class="control-label col-lg-12"></label>
                                      <label class="control-label col-lg-2">Первичное предложение, грн</label>
                                      <div class="col-lg-2">
                                          <input name="sum_per" id="sum_per" class="form-control"></input>
                                      </div>
                                      <label class="control-label col-lg-2">Окончательное предложение, грн</label>
                                      <div class="col-lg-2">
                                          <input name="sum_itog" id="sum_itog" class="form-control"></input>
                                      </div><label class="control-label col-lg-2">Сумма закупки, грн</label>
                                      <div class="col-lg-2">
                                          <input name="sum_purch" id="sum_purch" class="form-control"></input>
                                      </div>
                                      <label class="control-label col-lg-12"></label>
                                      <label class="control-label col-lg-2">Дата подачи</label>
                                      <div class="col-lg-2">
                                          <input name="date_app" id="date_app" class="form-control"></input>
                                      </div>
                                      <label class="control-label col-lg-2">Результат</label>
                                      <div class="col-lg-2" >
                                        <select name="result1" id="result1" class="form-control"  role="button" aria-expanded="false"><span class="caret"></span>
                                            <option value=""></option>
                                            <option value="Выиграли">Выиграли</option>
                                            <option value="Проиграли">Проиграли</option>
                                            <option value="Ожидание результата">Ожидание результата</option>
                                            <option value="Дисквалификация">Дисквалификация</option>
                                            <option value="Переторг">Переторг</option>
                                            <option value="Не участвуем">Не участвуем</option>
                                        </select>
                                      </div>
                                      <label class="control-label col-lg-2">Причина проигрыша</label>
                                      <div class="col-lg-2" >
                                        <select name="couse" id="couse" class="form-control"  role="button" aria-expanded="false"><span class="caret"></span>
                                                <option value="0"></option>
                                                <option value="Цена">Цена</option>
                                                <option value="Документы">Документы</option>
                                                <option value="Ассортимент">Ассортимент</option>
                                                <option value="Ошибка">Ошибка</option>

                                        </select>
                                      </div>
                                      <label class="control-label col-lg-12"></label>
                                      <label class="control-label col-lg-2">Победитель</label>
                                      <div class="col-lg-2">
                                          <input name="winner" id="winner" class="form-control"></input>
                                      </div>
                                      <label class="control-label col-lg-2">Сумма победителя</label>
                                      <div class="col-lg-2">
                                          <input name="sum_win" id="sum_win" class="form-control"></input>
                                      </div>
                                      <label class="control-label col-lg-2">Дата завершения</label>
                                      <div class="col-lg-2">
                                          <input name="date_over" id="date_over" class="form-control"></input>
                                      </div>
                                      <label class="control-label col-lg-12"></label>
                                      <label class="control-label col-lg-2">Ссылка на акцент</label>
                                      <div class="col-lg-10">
                                          <textarea rows="2" cols="1" class="form-control" name="accent" id="accent"></textarea>
                                      </div>

                                  </div>



                            </div>
                            <div class="controls">
                                <input type="hidden" id="id" name="id" value="0"/>
                                <input type="hidden" id="option" name="option" value="edit"/>
                                <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-primary col-sm-offset-2" onclick="$('#insert_form').hide()"/>
                                <button type="button" class="btn btn-danger" id = "spisok" data-dismiss="modal">Отмена</button>
                                <button type="button" class="btn btn-success" id = "parse" >Заполнить</button>
                                <button type="button" class="btn btn-success" id = "send">Уведомить</button>

                            </div>
                        </form>
    </div>
    <div class="col-sm-offset-2 col-sm-8">

            <p class="message"></p>
    </div>
    <form id="ModalFormDeleteData" action="" method="POST" >
                 <input type="hidden" id="id" name="id" value="0"/>
                 <input type="hidden" id="option" name="option" value="delete"/>
                    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog"
                        aria-labelledby="ModalHeader">

                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="ModalHeader">Удаление тендера</h4>

                                </div>

                                <div class="modal-body" >

                                    Вы действительно хотите удалить тендер?<strong data-name=""></strong>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" id="delete_id" class="btn btn-primary" data-dismiss="modal">Да, удалить</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>

                                </div>

                            </div>

                        </div>

                    </div>
    </form>
    <?php }?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script src="js/dataTables.buttons.js"></script>
<script src="js/buttons.bootstrap.js"></script>
<script src="js/buttons.html5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="js/get-tenders.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<script src="https://use.fontawesome.com/172271004b.js"></script>
<script src="js/common.js"></script>
<script type="application/javascript">

    $(document).on("ready", function () {

       spisok();
      // load_options();
       modify();
       delete1();
       parse();
       filter();
       LoginRegistration();
       login();
       signup();
       //columns();
       loop();
       addInputSearch();
       //click(); редактирование ячейки
       //getdataForm();
       option_save();
       //checkboxName();
       sendMail();
       
       visibleOnLoad();
       

    });



  
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>