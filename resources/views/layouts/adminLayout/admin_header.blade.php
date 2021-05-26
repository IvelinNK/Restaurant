<!--Header-part-->
<div id="header">
    <h1><a href="{{ route('admin.dashboard') }}">PartyBox</a></h1>
</div>
  <!--close-Header-part-->

  <!--top-Header-menu-->
  <div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class=""><a title="" href="{{ route('admin.settings') }}"><i class="icon icon-cog"></i> <span class="text">Администраторски настройки</span></a></li>
        <li class=""><a title="" href="{{ route('logout') }}"><i class="icon icon-share-alt"></i> <span class="text">Изход</span></a></li>
    </ul>
  </div>
  <!--close-top-Header-menu-->
