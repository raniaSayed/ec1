<?php

/* Translation */
$TR = "admin_panel.AN";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.sub-header')
    <title>documentations (beta)</title>

    <link rel="stylesheet" type="text/css" href="./packages/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./back/assets/css/pages/documentation.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/custom/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body data-spy="scroll" data-target=".scrollspy">
    <nav id="navbar-1" class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
            <img alt="Brand" src="./assets/icons/logo-icon.png" width="24px" title='{{ trans2("A479", "Home page (frontend)") }}'>
            <b>{{ $global_setting->site_name }}</b>
          </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="/products">{{ trans2("A480", "all ::products (frontend)", ["products"=>"products"]) }}</a></li>
            <li><a href="/admin">dashboard</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div id="affix-container" class="container">
        <div class="row">
          <div class="col-md-3 scrollspy">
            <ul id="nav" class="nav hidden-xs hidden-sm" data-spy="affix">
              <li>
                <a href="#features">
                    <span class="fa fa-star-o"></span>
                    &nbsp; Features
                </a>
              </li>
              <li>
                <a href="#about-us">
                    <span class="fa fa-hand-peace-o"></span>
                    &nbsp; About us
                </a>
            </li>
              <li><a href="#marketing">Marketing</a></li>
              <li><a href="#graphic-design">Graphic Design</a></li>
              <li><a href="#logistics">Logistics</a></li>
              <li><a href="#social">Social</a></li>
              <li><a href="#management">Management</a></li>
              <li><a href="#chemistry">Chemistry</a></li>
              <li><a href="#mobile-development">Mobile Development</a>
                <ul class="nav">
                  <li><a href="#android"><span class="fa fa-angle-double-right"></span>Android</a></li>
                  <li><a href="#iOS"><span class="fa fa-angle-double-right"></span>iOS</a></li>
                </ul>
              </li>
              <li><a href="#mathematics">Mathematics</a></li>
            </ul>
          </div>

          <div class="col-md-9">
            <section id="features">
              <h2>
                <span class="fa fa-star-o"></span> 
                Features
              </h2>
              <!--p>
                <dropzone
                don't forget to edit php.ini file
                Image operations tend to be quite memory exhausting because image handling libraries usually 'unpack' all the pixels to memory. A JPEG file of 3MB can thus easily grow to 60MB in memory and that's when you've probably hit the memory limit allocated for PHP.

                As far I remember, XAMP only allocates 128 MB RAM for PHP.

                Check your php.ini and increase the memory limit, e.g.:

                memory_limit = 512MB

                can't run more than 1 seed in 1 shoot, only first seed will runs cuz not do interpoletion
              
                * remove translation by super admin only
                * in translation section: set id as unique value because don't make confilect with another translations
              </p-->
              <ol type="1">
                  <li>
                        <h3>Bootstrap responsiveness</h3>
                        <span>special respondent tables</span>
                        <span>nice in mobile view</span>
                  </li>
                  <li>
                        <h3>Multi filter on your products</h3>
                        <span>where you can search by name, price and any product status in same time.</span>
                  </li>
                  <li>
                        <h3>Sort by any parameters</h3>
                        <span>when click on table title it's sorted by it's title</span>
                  </li>
                  <li>
                        <h3>Generate unique product serial number</h3>
                  </li>
                  <li>
                        <h3>Nested categories</h3>
                        <span>full system of categories to add, update and delete categories by easer way</span>
                  </li>
                  <li>
                        <h3>Tags system</h3>
                        <span>create, update and delete tags by easer way</span>
                  </li>
                  <li>
                        <h3>Start viewing and expires condition</h3>
                        <span>specifies when the product will start displaying and when the offer will end</span>
                  </li>
                  <li>
                        <h3>Multi image and carousel uploading</h3>
                        <span>easy image and carousel upload by drag and drop</span>
                  </li>
                  <li>
                        <h3>Multi payments</h3>
                        <span>
                            <span class="fa fa-paypal"></span>&nbsp; paypal |
                            <span class="fa fa-truck"></span>&nbsp; delivery
                        </span>
                  </li>
                  <li>
                        <h3>Multi login methods</h3>
                        <span>
                            <span class="fa fa-github"></span>&nbsp; by github | 
                            <span class="fa fa-google"></span>&nbsp; by google plus | 
                            <span class="fa fa-facebook"></span>&nbsp; by facebook
                        </span>
                  </li>
                  <li>
                      <h3>Sub admins permessions</h3>
                      <span>customize your staff to do some different work</span>
                  </li>
              </ol>
            </section>

            <section id="about-us">
                <h2>
                    <span class="fa fa-hand-peace-o"></span>
                    About us
                </h2>
                <ol type="1">
                    <li>
                        <h2>Who we are?</h2>
                        <span><b>definition and vision:</b> We are a team of at least two people. Our goal is to set up electronic software projects that serve various institutions, which in turn have multiple axes to adapt to the needs of our customers. We strive to achieve the highest quality in our products.</span>
                        <span>
                            <b>social media:</b><br>
                            Ahmed Sayed Ahmed: 
                            <a href="#">ahmedsk128@gmail.com</a> | 
                            <a href="https://www.facebook.com/ahmedsk6" style="color: #3b5998"><span class="fa fa-facebook"></span></a> |
                            <a href="https://www.youtube.com/channel/UCAYRvtY2dIMriTSuLgrysGg" style="color: #cd201f"><span class="fa fa-youtube"></span></a><br>
                            <span>mobile: (+20) 01149470758 | (+20) 01010495121</span>
                            <br><br>

                            Mohamed Medhat: 
                            <a href="#">medhat929@gmail.com</a> | 
                            <a href="https://www.facebook.com/m.mdht" style="color: #3b5998"><span class="fa fa-facebook"></span></a><br>
                            <span>mobile: (+20) 01111350338</span>
                        </span>
                        <!--span>نحن فريق عمل مكون من شخصين على الاقل هدفنا انشاء المشاريع البرمجية الالكترونية التى تخدم المؤسسات المختلفة والتى بدورها ذات محاور متعددة لتتأقلم مع احتياجات عملائنا، نسعى ديما لتحقيق اعلى جودة فى منتاجاتنا</span-->
                    </li>
                    <li>
                        <h2>History</h2>
                        <span>bla bla blaa</span>
                    </li>
                    <li>
                        <h2>Skills</h2>
                        <span>bla bla blaa</span>
                    </li>
                </ol>
            </section>

            <section id="web-development">
              <h2><span class="fa fa-edit"></span> Web Development</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc. Etiam ultricies nisi vel augue.
                Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus,
                tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.Nam
                quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>

              <section id="ruby">
                <h3>Ruby</h3>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <button type="button" class="btn btn-primary">Learn More</button>
              </section><!--end of #ruby-->

              <section id="python">
                <h3>Python</h3>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <button type="button" class="btn btn-primary">Learn More</button>
              </section><!--end of #python-->

              <section id="php">
                <h3>PHP</h3>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <button type="button" class="btn btn-primary">Learn More</button>
              </section><!--end of #php-->
            </section><!--end of #web-devlopment-->

            <section id="marketing">
              <h2><span class="fa fa-edit"></span> Marketing</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
              </p>
              <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in,
                viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.
                Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet
                adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <button type="button" class="btn btn-primary">Learn More</button>
            </section><!--end of #marketing-->

            <section id="graphic-design">
              <h2><span class="fa fa-edit"></span> Graphic Design</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc. Etiam ultricies nisi vel augue.
                Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus,
                tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <button type="button" class="btn btn-primary">Learn More</button>
            </section><!--end of #graphic-design-->

            <section id="logistics">
              <h2><span class="fa fa-edit"></span> Logistics</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.
                Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus,
                tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <button type="button" class="btn btn-primary">Learn More</button>
            </section><!--end of #logistics-->

            <section id="social">
              <h2><span class="fa fa-edit"></span> Social</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
              </p>
              <p>Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus,
                tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris
                sit amet nibh. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <button type="button" class="btn btn-primary">Learn More</button>
            </section><!--end of #social-->

            <section id="management">
              <h2><span class="fa fa-edit"></span> Management</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in,
                viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.
                Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet
                adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
              </p>
              <button type="button" class="btn btn-primary">Learn More</button>
            </section><!--end of #management-->

            <section id="chemistry">
              <h2><span class="fa fa-edit"></span> Chemistry</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.
                Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus,
                tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <button type="button" class="btn btn-primary">Learn More</button>
            </section><!--end of #chemistry-->

            <section id="mobile-development">
              <h2><span class="fa fa-edit"></span> Mobile Development</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc. Etiam ultricies nisi vel augue.
                Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus,
                tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante
                tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
              </p>

              <section id="android">
                <h3>Android Development</h3>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                luctus pulvinar, hendrerit id, lorem.
                </p>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <button type="button" class="btn btn-primary">Learn More</button>
              </section><!--end of #android-->

              <section id="iOS">
                <h3>iOS Development</h3>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Nam quam nunc, blandit vel,
                  luctus pulvinar, hendrerit id, lorem.
                </p>
                <button type="button" class="btn btn-primary">Learn More</button>
              </section><!--end of #iOS-->
            </section><!--end of #mobile-development-->
            
            <section id="mathematics">
              <h2><span class="fa fa-edit"></span> Mathematics</h2>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc. Etiam ultricies nisi vel augue.
                Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus,
                tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean
                massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec
                quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.
                Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
              </p>
              <button type="button" class="btn btn-primary">Learn More</button>
            </section><!--end of #mathematics-->
          </div>
        </div><!--end of .row-->
    </div><!--end of .container-->
</body>

<script type="text/javascript" src="./assets/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="./packages/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./assets/js/links-optimization.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#nav').affix({
            offset: {     
              top: $('#nav').offset().top        
            }
        })
    });
</script>

</html>

