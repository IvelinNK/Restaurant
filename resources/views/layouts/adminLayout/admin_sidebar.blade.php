<?php use App\Category; ?>
<?php use App\Product; ?>
<?php use App\Order; ?>
<!--sidebar-menu-->
<div id="sidebar"><a href="{{ route('admin.dashboard') }}" class="visible-phone"><i class="icon icon-home"></i> Панел Управление</a>
    <ul>
      <li class="active"><a href="{{ route('admin.dashboard') }}"><i class="icon icon-home"></i> <span>Панел Управление</span></a> </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Продукти</span> <span class="label label-important">{{ Product::count() }}</span></a>
        <ul>
          <li><a href="{{ route('admin.add-product') }}">Добави продукт</a></li>
          <li><a href="{{ route('admin.view-products') }}">Всички продукти</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Категории обяви</span> <span class="label label-important">{{ Category::count() }}</span></a>
        <ul>
          <li><a href="{{ route('admin.add-category') }}">Добави категория</a></li>
          <li><a href="{{ route('admin.view-categories') }}">Всички категории</a></li>
        </ul>
      </li>
      <li><a href="{{ route('admin.view-orders') }}"><i class="icon icon-th-list"></i> <span>Поръчки</span> <span class="label label-important">{{ Order::count() }}</span></a></li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Настройки</span> </a>
        <ul>
          <li><a href="{{ route('admin.edit-landing-page') }}">Начална страница</a></li>
          <li><a href="{{ route('admin.edit-maintenance-page') }}">Режим поддръжка</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <!--sidebar-menu-->
