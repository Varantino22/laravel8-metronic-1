<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
            <!--begin:Menu item-->
           

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{url('dashboard')}}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-element-11 fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                        </i>
                    </span>
                    <span class="menu-title">Dashboards</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->


            @php
            #GET MENU SIDEBAR FROM DATABASE

            $res_label = DB::select('select * from setting_menu where type = "label" order by ord');

            for ($keylabel = 0; $keylabel < count($res_label); $keylabel++) { 
                $lb = $res_label[$keylabel];
                $array_label[$keylabel] = [];
                $res_menu  =DB::select('select * from setting_menu where menu_parent = '.$res_label[$keylabel]->id.' order by ord');
                $lmn = [];
                for ($key = 0; $key < count($res_menu); $key++) {
                    $mn = $res_menu[$key];
                    $array_menu[$key] = [];
                    $res_submenu[$key]  = DB::select('select * from setting_menu where menu_parent = '.$res_menu[$key]->id.' order by ord');
                    $smn = [];
                    for ($smnkey = 0; $smnkey < count($res_submenu[$key] ); $smnkey++) {
                    array_push($smn, $res_submenu[$key][$smnkey]);
                    }
                    $mn->submenu =  $smn;
                }
                $lb->menu = $res_menu;
                array_push( $array_label[$keylabel], $res_label);
                
            }
            @endphp

            @foreach ($res_label as $label)
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">{{ $label->menu_name }}</span>
                    </div>
                    <!--end:Menu content-->
                </div>

                @foreach ($label->menu as $menu)

                    @if (count($menu->submenu)!=null)
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="ki-duotone {{ $menu->menu_icon }} fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ $menu->menu_name }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                @foreach ($menu->submenu as $submenu)
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ url('') }}/{{ $submenu->menu_url }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ $submenu->menu_name }} </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->  
                                @endforeach
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    @else
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="https://preview.keenthemes.com/html/metronic/docs/base/utilities" target="_blank">
                                <span class="menu-icon">
                                    <i class="ki-duotone {{ $menu->menu_icon }} fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ $menu->menu_name }}s</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    @endif
                @endforeach
            @endforeach

            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Setting</span>
                </div>
                <!--end:Menu content-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-gear fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Web</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-send fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Mail</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="" target="_blank">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-picture fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Slider</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Tools</span>
                </div>
                <!--end:Menu content-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('crud') }}" target="_blank">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-square-brackets fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">CRUD Generator</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('apibuilder') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-square-brackets fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">API Builder</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('/') }}" target="_blank">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-square-brackets fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Page Builder</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('/setting_menu') }}" target="_blank">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-square-brackets fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Menu</span>
                </a>
                <!--end:Menu link-->
            </div>


        </div>

        


        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>

<div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
    <a href="https://preview.keenthemes.com/html/metronic/docs" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
        <span class="btn-label">Docs & Components</span>
        <i class="ki-duotone ki-document btn-icon fs-2 m-0">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </a>
</div>