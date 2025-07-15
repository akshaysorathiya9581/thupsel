@php
    $admin_logo=getSettingsValByName('company_logo');
    $ids     = parentId();
    $authUser=\App\Models\User::find($ids);
 $subscription = \App\Models\Subscription::find($authUser->subscription);
 $routeName=\Request::route()->getName();
@endphp
<aside class="codex-sidebar sidebar-{{$settings['sidebar_mode']}}">
    <div class="logo-gridwrap">
        <a class="codexbrand-logo" href="{{route('home')}}">
            <img class="img-fluid"
                 src="{{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                 alt="theeme-logo">
        </a>
        <a class="codex-darklogo" href="{{route('home')}}">
            <img class="img-fluid"
                 src="{{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                 alt="theeme-logo"></a>
        <div class="sidebar-action"><i data-feather="menu"></i></div>
    </div>
    <div class="icon-logo">
        <a href="{{route('home')}}">
            <img class="img-fluid"
                 src="{{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                 alt="theeme-logo">
        </a>
    </div>
    <div class="codex-menuwrapper">
        <ul class="codex-menu custom-scroll" data-simplebar>
            <li class="cdxmenu-title">
                <h5>{{__('Home')}}</h5>
            </li>
            <li class="menu-item {{in_array($routeName,['dashboard',''])?'active':''}}">
                <a href="{{route('dashboard')}}">
                    <div class="icon-item"><i data-feather="home"></i></div>
                    <span>{{__('Dashboard')}}</span>
                </a>
            </li>

            @if(\Auth::user()->type=='super admin')
                @if(Gate::check('manage user'))
                    <li class="menu-item {{in_array($routeName,['users.index'])?'active':''}}">
                        <a href="{{route('users.index')}}">
                            <div class="icon-item"><i data-feather="users"></i></div>
                            <span>{{__('Users')}}</span>
                        </a>
                    </li>
                @endif
            @else
                @if(Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage logged history') )
                    <li class="menu-item {{in_array($routeName,['users.index','logged.history','role.index','role.create','role.edit'])?'active':''}}">
                        <a href="javascript:void(0);">
                            <div class="icon-item"><i data-feather="users"></i></div>
                            <span>{{__('Staff Management')}}</span><i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="submenu-list"
                            style="display: {{in_array($routeName,['users.index','logged.history','role.index','role.create','role.edit'])?'block':'none'}}">
                            @if(Gate::check('manage user'))
                                <li class="{{in_array($routeName,['users.index'])?'active':''}}">
                                    <a href="{{route('users.index')}}">{{__('Users')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage role'))
                                <li class=" {{in_array($routeName,['role.index','role.create','role.edit'])?'active':''}}">
                                    <a href="{{route('role.index')}}">
                                        {{__('Roles')}}
                                    </a>
                                </li>
                            @endif
                            @if(Gate::check('manage logged history') && $subscription->enabled_logged_history==1)
                                <li class="{{in_array($routeName,['logged.history'])?'active':''}}">
                                    <a href="{{route('logged.history')}}">{{__('Logged History')}}</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
            @endif

            @if(Gate::check('manage service & part') || Gate::check('manage asset') || Gate::check('manage wo request') ||  Gate::check('manage client') || Gate::check('manage estimation') || Gate::check('manage work order') || Gate::check('manage contact') || Gate::check('manage note') || Gate::check('manage category') )
                <li class="cdxmenu-title">
                    <h5>{{__('Business Management')}}</h5>
                </li>

                @if(Gate::check('manage client'))
                    <li class="menu-item {{in_array($routeName,['client.index','client.show'])?'active':''}}">
                        <a href="{{route('client.index')}}">
                            <div class="icon-item"><i data-feather="user-check"></i></div>
                            <span>{{__('Client')}}</span>
                        </a>
                    </li>
                @endif
                @if(Gate::check('manage category'))
                    <li class="menu-item {{in_array($routeName,['category.index','category.show'])?'active':''}}">
                        <a href="{{route('category.index')}}">
                            <div class="icon-item"><i data-feather="user-check"></i></div>
                            <span>{{__('Category')}}</span>
                        </a>
                    </li>
                @endif
                @if(Gate::check('manage service & part'))
                    <li class="menu-item {{in_array($routeName,['services-parts.index','services-parts.show'])?'active':''}}">
                        <a href="{{route('services-parts.index')}}">
                            <div class="icon-item"><i data-feather="list"></i></div>
                            <span>{{__('Services & Parts')}}</span>
                        </a>
                    </li>
                @endif
                @if(Gate::check('manage asset'))
                    <li class="menu-item {{in_array($routeName,['asset.index'])?'active':''}}">
                        <a href="{{route('asset.index')}}">
                            <div class="icon-item"><i data-feather="shopping-cart"></i></div>
                            <span>{{__('Asset')}}</span>
                        </a>
                    </li>
                @endif
                @if(Gate::check('manage wo request'))
                    <li class="menu-item {{in_array($routeName,['wo-request.index'])?'active':''}}">
                        <a href="{{route('wo-request.index')}}">
                            <div class="icon-item"><i data-feather="navigation"></i></div>
                            <span>{{__('WO Request')}}</span>
                        </a>
                    </li>
                @endif
                @if(Gate::check('manage estimation'))
                    <li class="menu-item {{in_array($routeName,['estimation.index','estimation.create' , 'estimation.edit' , 'estimation.show'])?'active':''}}">
                        <a href="{{route('estimation.index')}}">
                            <div class="icon-item"><i data-feather="file-text"></i></div>
                            <span>{{__('Estimation')}}</span>
                        </a>
                    </li>
                @endif

                @if(Gate::check('manage work order'))
                    <li class="menu-item {{in_array($routeName,['workorder.index','workorder.create' , 'workorder.edit' , 'workorder.show'])?'active':''}}">
                        <a href="{{route('workorder.index')}}">
                            <div class="icon-item"><i data-feather="award"></i></div>
                            <span>{{__('Work Order')}}</span>
                        </a>
                    </li>
                @endif
                @if(Gate::check('manage invoice'))
                    <li class="menu-item {{in_array($routeName,['invoice.index','invoice.show'])?'active':''}}">
                        <a href="{{route('invoice.index')}}">
                            <div class="icon-item"><i data-feather="file-plus"></i></div>
                            <span>{{__('Invoice')}}</span>
                        </a>
                    </li>
                @endif


                @if(Gate::check('manage contact'))
                    <li class="menu-item {{in_array($routeName,['contact.index'])?'active':''}}">
                        <a href="{{route('contact.index')}}">
                            <div class="icon-item"><i data-feather="phone-call"></i></div>
                            <span>{{__('Contact')}}</span>
                        </a>
                    </li>
                @endif

                @if(Gate::check('manage note'))
                    <li class="menu-item {{in_array($routeName,['note.index'])?'active':''}} ">
                        <a href="{{route('note.index')}}">
                            <div class="icon-item"><i data-feather="file-text"></i></div>
                            <span>{{__('Note')}}</span>
                        </a>
                    </li>
                @endif
            @endif

            <li class="menu-item {{in_array($routeName,['parts.index'])?'active':''}} ">
                <a href="{{route('parts.index')}}">
                    <div class="icon-item"><i data-feather="file-text"></i></div>
                    <span>{{__('History Tracking')}}</span>
                </a>
            </li>

            @if(Gate::check('manage wo type')  )
                <li class="cdxmenu-title">
                    <h5>{{__('System Setup')}}</h5>
                </li>

                @if(Gate::check('manage wo type'))
                    <li class="menu-item {{in_array($routeName,['wo-type.index'])?'active':''}}">
                        <a href="{{route('wo-type.index')}}">
                            <div class="icon-item"><i data-feather="sliders"></i></div>
                            <span>{{__('WO Type')}}</span>
                        </a>
                    </li>
                @endif
            @endif

            @if(Gate::check('manage pricing packages') || Gate::check('manage pricing transation') || Gate::check('manage account settings') || Gate::check('manage password settings') || Gate::check('manage general settings') || Gate::check('manage email settings')  || Gate::check('manage payment settings') || Gate::check('manage company settings') || Gate::check('manage seo settings') || Gate::check('manage google recaptcha settings'))
                <li class="cdxmenu-title">
                    <h5>{{__('System Settings')}}</h5>
                </li>
                @if(Gate::check('manage pricing packages') || Gate::check('manage pricing transation'))
                    <li class="menu-item {{in_array($routeName,['subscriptions.index','subscriptions.show','subscription.transaction'])?'active':''}}">
                        <a href="javascript:void(0);">
                            <div class="icon-item"><i data-feather="database"></i></div>
                            <span>{{__('Pricing')}}</span><i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="submenu-list"
                            style="display: {{in_array($routeName,['subscriptions.index','subscriptions.show','subscription.transaction'])?'block':'none'}}">
                            @if(Gate::check('manage pricing packages'))
                                <li class="{{in_array($routeName,['subscriptions.index','subscriptions.show'])?'active':''}}">
                                    <a href="{{route('subscriptions.index')}}">{{__('Packages')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage pricing transation'))
                                <li class="{{in_array($routeName,['subscription.transaction'])?'active':''}} ">
                                    <a href="{{route('subscription.transaction')}}">{{__('Transactions')}}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(Gate::check('manage coupon') || Gate::check('manage coupon history'))
                    <li class="menu-item {{in_array($routeName,['coupons.index','coupons.history'])?'active':''}}">
                        <a href="javascript:void(0);">
                            <div class="icon-item"><i data-feather="gift"></i></div>
                            <span>{{__('Coupons')}}</span><i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="submenu-list"
                            style="display: {{in_array($routeName,['coupons.index','coupons.history'])?'block':'none'}}">
                            @if(Gate::check('manage coupon'))
                                <li class="{{in_array($routeName,['coupons.index'])?'active':''}}">
                                    <a href="{{route('coupons.index')}}">{{__('All Coupon')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage coupon history'))
                                <li class="{{in_array($routeName,['coupons.history'])?'active':''}}">
                                    <a href="{{route('coupons.history')}}">{{__('Coupon History')}}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(Gate::check('manage account settings') || Gate::check('manage password settings') || Gate::check('manage general settings') || Gate::check('manage email settings')  || Gate::check('manage payment settings') || Gate::check('manage company settings') || Gate::check('manage seo settings') || Gate::check('manage google recaptcha settings'))
                    <li class="menu-item {{in_array($routeName,['setting.account','setting.password','setting.general','setting.company','setting.smtp','setting.payment','setting.site.seo','setting.google.recaptcha'])?'active':''}}">
                        <a href="javascript:void(0);">
                            <div class="icon-item"><i data-feather="settings"></i></div>
                            <span>{{__('Settings')}}</span><i class="fa fa-angle-down"></i></a>
                        <ul class="submenu-list "
                            style="display: {{in_array($routeName,['setting.account','setting.password','setting.general','setting.company','setting.smtp','setting.payment','setting.site.seo','setting.google.recaptcha'])?'block':'none'}}">
                            @if(Gate::check('manage account settings'))
                                <li class="{{in_array($routeName,['setting.account'])?'active':''}} ">
                                    <a href="{{route('setting.account')}}">{{__('Account Setting')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage password settings'))
                                <li class="{{in_array($routeName,['setting.password'])?'active':''}}">
                                    <a href="{{route('setting.password')}}">{{__('Password Setting')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage general settings'))
                                <li class="{{in_array($routeName,['setting.general'])?'active':''}} ">
                                    <a href="{{route('setting.general')}}">{{__('General Setting')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage company settings'))
                                <li class="{{in_array($routeName,['setting.company'])?'active':''}}">
                                    <a href="{{route('setting.company')}}">{{__('Company Setting')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage email settings'))
                                <li class="{{in_array($routeName,['setting.smtp'])?'active':''}} ">
                                    <a href="{{route('setting.smtp')}}">{{__('Email Setting')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage payment settings'))
                                <li class="{{in_array($routeName,['setting.payment'])?'active':''}} ">
                                    <a href="{{route('setting.payment')}}">{{__('Payment Setting')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage seo settings'))
                                <li class="{{in_array($routeName,['setting.site.seo'])?'active':''}} ">
                                    <a href="{{route('setting.site.seo')}}">{{__('Site SEO Setting')}}</a>
                                </li>
                            @endif
                            @if(Gate::check('manage google recaptcha settings'))
                                <li class="{{in_array($routeName,['setting.google.recaptcha'])?'active':''}} ">
                                    <a href="{{route('setting.google.recaptcha')}}">{{__('ReCaptcha Setting')}}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

            @endif


        </ul>
    </div>
</aside>
<!-- sidebar end-->
