<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'><i class='nav-icon fa fa-folder'></i> Категории</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon fa fa-windows'></i> Продукты</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('vacancy') }}'><i class='nav-icon fa fa-picture-o'></i> Вакансии</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('phone') }}'><i class='nav-icon fa fa-mobile-phone'></i> Телефоны</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact') }}'><i class='nav-icon fa fa-phone'></i> Контакты</a></li>
