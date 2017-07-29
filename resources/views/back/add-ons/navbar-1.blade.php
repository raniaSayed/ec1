<nav id="navbar-1" class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">{{ trans2("A200", "Toggle navigation") }}</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        <img alt="Brand" src="./assets/icons/logo-icon.png" width="24px" title='{{ trans2("A201", "Home page (frontend)") }}'>
        <b>{{ $global_setting->site_name }}</b>
      </a>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/products">{{ trans2("A202", "All ::products (frontend)", ["products"=>"products"]) }}</a></li>
        <li><a href="/admin/documentations">{{ trans2("A203", "documentations") }}</a></li>
      </ul>
      <div class="navbar-right">
        <ul class="nav navbar-nav">
          <li><a onclick="return false;">{{ trans2("A204", "welcome ::name", ["name"=>Auth::user()->name]) }}</a></li>
          <li><a href="/logout">{{ trans2("A205", "logout") }}</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              {{ trans2("A206", "languages") }} ({{ $supported_trans->$main_lang->content }})
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              @foreach($supported_trans as $key => $value)
                <li><a href="/locale/set-locale/{{ $key }}">{{ $value->content }}</a></li>
              @endforeach
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>