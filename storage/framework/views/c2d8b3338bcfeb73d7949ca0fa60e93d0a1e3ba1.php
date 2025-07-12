<!DOCTYPE html>
<html lang="en">
<?php
    $settings=settings();
     $user=\App\Models\User::find(1);
    \App::setLocale($user->lang);
?>

<head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(env('APP_NAME')); ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta name="author" content="<?php echo e(!empty($settings['app_name'])?$settings['app_name']:env('APP_NAME')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(!empty($settings['app_name'])?$settings['app_name']:env('APP_NAME')); ?> - <?php echo $__env->yieldContent('page-title'); ?> </title>

    <meta name="title" content="<?php echo e($settings['meta_seo_title']); ?>">
    <meta name="keywords" content="<?php echo e($settings['meta_seo_keyword']); ?>">
    <meta name="description" content="<?php echo e($settings['meta_seo_description']); ?>">


    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($settings['meta_seo_title']); ?>">
    <meta property="og:description" content="<?php echo e($settings['meta_seo_description']); ?>">
    <meta property="og:image" content="<?php echo e(asset(Storage::url('upload/seo')).'/'.$settings['meta_seo_image']); ?>">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($settings['meta_seo_title']); ?>">
    <meta property="twitter:description" content="<?php echo e($settings['meta_seo_description']); ?>">
    <meta property="twitter:image" content="<?php echo e(asset(Storage::url('upload/seo')).'/'.$settings['meta_seo_image']); ?>">

    <!-- shortcut icon-->
    <link rel="icon" href="<?php echo e(asset(Storage::url('upload/logo')).'/'.$settings['company_favicon']); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset(Storage::url('upload/logo')).'/'.$settings['company_favicon']); ?>" type="image/x-icon">

    <!-- shortcut icon-->
    <link rel="shortcut icon" href="<?php echo e(asset(Storage::url('upload/logo')).'/favicon.png'); ?>" type="image/x-icon">
    <!-- Fonts css-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font awesome -->
    <link href="<?php echo e(asset('assets/css/vendor/font-awesome.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/vendor/icoicon/icoicon.css')); ?>" rel="stylesheet">
    <!-- animat css-->
    <link href="<?php echo e(asset('assets/css/vendor/animate.css')); ?>" rel="stylesheet">
    <!-- Bootstrap css-->
    <link href="<?php echo e(asset('assets/css/vendor/bootstrap.css')); ?>" rel="stylesheet">
    <!-- Custom css-->

    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">
</head>

<body  class="<?php echo e($settings['layout_direction']); ?> <?php echo e($settings['layout_mode']); ?>">
<!-- header start-->
<header class="land-header fixed">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header-contain position-relative">
                    <div class="codex-brand">
                        <a href="javascript:void(0);">
                            <img class="img-fluid dark-logo landing-logo"
                                 src="<?php echo e(asset(Storage::url('upload/logo')).'/'.$settings['landing_logo']); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="menu-block">
                            <ul class="menu-list">
                                <li class="d-xl-none">
                                    <a class="close-menu" href="javascript:void(0);">
                                        <div class="menu-brand">
                                            <img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>"
                                                 alt=""><i data-feather="x"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="menu-item"><a href="#demos"><?php echo e(__('Home')); ?></a></li>
                                <li class="menu-item"><a href="#features"><?php echo e(__('Features')); ?></a></li>

                                <li class="menu-item">
                                    <a class="btn btn-primary me-2" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?> </a>
                                    <?php if($settings['register_page']=='on'): ?>
                                        <a class="btn btn-primary" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?> </a>
                                    <?php endif; ?>

                                </li>

                            </ul>
                            <a class="menu-action d-xl-none" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end-->

<!-- intro start-->
<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7 col-lg-7">
                <div class="intro-contain">
                    <div>
                        <h1 class="wow fadeInLeft" data-wow-duration="1s"><?php echo e(__('Smart FSM - Field Service Management System')); ?></h1>
                        <p class="wow fadeInLeft" data-wow-duration="1.5s"><?php echo e(__('FSM systems facilitate better communication between the office and field staff, leading to improved productivity, customer satisfaction, and operational efficiency.')); ?></p>
                        <a class="btn btn-primary" href="<?php echo e(route('login')); ?>" data-wow-duration="1.8s"><i  class="fa fa-television" aria-hidden="true"></i><?php echo e(__('Live Demo')); ?> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- intro end-->
<!-- demo start-->
<section class="space-py-100" id="demos">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="land-title">
                    <h2 class="wow fadeInLeft"><?php echo e(__('Home')); ?></h2>
                    <p class="wow fadeInRight"><?php echo e(__('FSM systems facilitate better communication between the office and field staff, leading to improved productivity, customer satisfaction, and operational efficiency.')); ?></p>
                </div>
            </div>
        </div>
        <div class="row cdx-row justify-content-center">
            <div class="col-md-6 wow fadeInUp" data-wow-duration="0.8s">
                <div class="demo-grid">
                    <div class="img-wrap">
                        <img class="img-fluid" src="<?php echo e(asset('assets/images/landing/1.png')); ?>" alt="">
                        <div class="group-link">
                            <a class="hover-link" href="javascript:void(0);">
                                <img class="img-fluid" src="<?php echo e(asset('assets/images/landing/feathure/bootstrap.png')); ?>"
                                     alt=""></a>
                            <a class="hover-link" href="javascript:void(0);">
                                <img class="img-fluid" src="<?php echo e(asset('assets/images/landing/feathure/tailwind.png')); ?>"
                                     alt=""></a></div>
                    </div>
                    <div class="demo-detail">
                        <h3><?php echo e(__('Home')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 wow fadeInUp" data-wow-duration="1.5s">
                <div class="demo-grid">
                    <div class="img-wrap">
                        <img class="img-fluid" src="<?php echo e(asset('assets/images/landing/2.png')); ?>" alt="">
                        <div class="group-link">
                            <a class="hover-link"
                               href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/bootstrap.png')); ?>"
                                    alt=""></a><a class="hover-link"
                                                  href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/tailwind.png')); ?>"
                                    alt=""></a></div>
                    </div>
                    <div class="demo-detail">
                        <h3><?php echo e(__('Workorder')); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- demo end-->
<!-- header otpion start-->
<section class="landheader-comp space-py-100 overflow-visible">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="header-detail">
                    <div>
                        <h2 class="wow fadeInUp" data-wow-duration="0.8s">500+ <?php echo e(__('Clients')); ?></h2>
                        <p class="wow fadeInUp" data-wow-duration="1.3s"><?php echo e(__('FSM systems facilitate better communication between the office and field staff, leading to improved productivity, customer satisfaction, and operational efficiency.')); ?></p><a
                            class="btn btn-primary btn-md wow fadeInUp" data-wow-duration="1.8s"
                            href="javascript:void(0);"><?php echo e(__('Exploar now')); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row cdx-row">

                    <div class="col-lg-12 col-md-6">
                        <div class="demo-grid">
                            <div class="img-wrap"><img class="img-fluid"
                                                       src="<?php echo e(asset('assets/images/landing/3.png')); ?>"
                                                       alt=""></div>
                            <div class="demo-detail">
                                <h3 class="text-white"><?php echo e(__('Workorder Details')); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="demo-grid">
                            <div class="img-wrap"><img class="img-fluid"
                                                       src="<?php echo e(asset('assets/images/landing/4.png')); ?>"
                                                       alt=""></div>
                            <div class="demo-detail">
                                <h3 class="text-white"><?php echo e(__('Services & Parts')); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="demo-grid">
                            <div class="img-wrap"><img class="img-fluid"
                                                       src="<?php echo e(asset('assets/images/landing/5.png')); ?>"
                                                       alt=""></div>
                            <div class="demo-detail">
                                <h3 class="text-white"><?php echo e(__('Invoice')); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="demo-grid">
                            <div class="img-wrap"><img class="img-fluid"
                                                       src="<?php echo e(asset('assets/images/landing/6.png')); ?>"
                                                       alt=""></div>
                            <div class="demo-detail">
                                <h3 class="text-white"><?php echo e(__('Roles & Permissions')); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- header otpion End-->
<!-- innderpages start-->
<section class="space-py-100" id="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="land-title">
                    <h2 class="wow fadeInUp" data-wow-duration="1s"><?php echo e(__('Dedicated Features')); ?> </h2>
                </div>
            </div>
        </div>
        <div class="row cdx-row">
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="demo-grid">
                    <div class="img-wrap"><img class="img-fluid"
                                               src="<?php echo e(asset('assets/images/landing/1.png')); ?>"
                                               alt="">
                        <div class="group-link"><a class="hover-link"
                                                   href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/bootstrap.png')); ?>"
                                    alt=""></a><a class="hover-link"
                                                  href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/tailwind.png')); ?>"
                                    alt=""></a></div>
                    </div>
                    <div class="demo-detail">
                        <h3><?php echo e(__('Dashboard')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="demo-grid">
                    <div class="img-wrap"><img class="img-fluid"
                                               src="<?php echo e(asset('assets/images/landing/2.png')); ?>"
                                               alt="">
                        <div class="group-link"><a class="hover-link"
                                                   href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/bootstrap.png')); ?>"
                                    alt=""></a><a class="hover-link"
                                                  href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/tailwind.png')); ?>"
                                    alt=""></a></div>
                    </div>
                    <div class="demo-detail">
                        <h3><?php echo e(__('Workorder')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="demo-grid">
                    <div class="img-wrap"><img class="img-fluid"
                                               src="<?php echo e(asset('assets/images/landing/4.png')); ?>"
                                               alt="">
                        <div class="group-link"><a class="hover-link"
                                                   href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/bootstrap.png')); ?>"
                                    alt=""></a><a class="hover-link"
                                                  href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/tailwind.png')); ?>"
                                    alt=""></a></div>
                    </div>
                    <div class="demo-detail">
                        <h3><?php echo e(__('Services & Parts')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="demo-grid">
                    <div class="img-wrap"><img class="img-fluid"
                                               src="<?php echo e(asset('assets/images/landing/5.png')); ?>"
                                               alt="">
                        <div class="group-link"><a class="hover-link"
                                                   href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/bootstrap.png')); ?>"
                                    alt=""></a><a class="hover-link"
                                                  href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/tailwind.png')); ?>"
                                    alt=""></a></div>
                    </div>
                    <div class="demo-detail">
                        <h3><?php echo e(__('Invoice')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="demo-grid">
                    <div class="img-wrap"><img class="img-fluid"
                                               src="<?php echo e(asset('assets/images/landing/7.png')); ?>"
                                               alt="">
                        <div class="group-link"><a class="hover-link"
                                                   href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/bootstrap.png')); ?>"
                                    alt=""></a><a class="hover-link"
                                                  href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/tailwind.png')); ?>"
                                    alt=""></a></div>
                    </div>
                    <div class="demo-detail">
                        <h3><?php echo e(__('WO Request')); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="demo-grid">
                    <div class="img-wrap"><img class="img-fluid"
                                               src="<?php echo e(asset('assets/images/landing/6.png')); ?>"
                                               alt="">
                        <div class="group-link"><a class="hover-link"
                                                   href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/bootstrap.png')); ?>"
                                    alt=""></a><a class="hover-link"
                                                  href="javascript:void(0);"><img
                                    class="img-fluid"
                                    src="<?php echo e(asset('assets/images/landing/feathure/tailwind.png')); ?>"
                                    alt=""></a></div>
                    </div>
                    <div class="demo-detail">
                        <h3><?php echo e(__('Uer Roles & Permissions')); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- innderpages end-->


<!-- footer start-->
<footer class="lan-footer space-py-10">
    <div class="container">
        <div class="row">
            <div class="col-auto">
                <div class="support-contain">
                    <div class="codex-brand">
                        <a href="javascript:void(0);">
                            <img class="img-fluid wow fadeInUp landing-logo"
                                 src="<?php echo e(asset(Storage::url('upload/logo')).'/'.$settings['landing_logo']); ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col text-end">
                <div class="support-contain">
                    <div class="codex-brand">
                        <p class="mt-20"><?php echo e(__('Copyright')); ?> <?php echo e(date('Y')); ?> <?php echo e(env('APP_NAME')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end-->
<!-- tap to top start-->
<div class="scroll-top"><i class="fa fa-angle-double-up"></i></div>
<!-- tap to top end-->
<!-- main jquery-->
<script src="<?php echo e(asset('assets/js/jquery.js')); ?>"></script>
<!-- Feather iocns js-->
<script src="<?php echo e(asset('assets/js/icons/feather-icon/feather.js')); ?>"></script>
<!-- Wow js-->
<script src="<?php echo e(asset('assets/js/vendors/wow.min.js')); ?>"></script>
<!-- Bootstrap js-->
<script src="<?php echo e(asset('assets/js/bootstrap.bundle.js')); ?>"></script>
<script>
    //*** Header Js ***//
    $(window).scroll(function () {
        if ($(window).scrollTop() > 100) {
            $('header').addClass('sticky');
        } else {
            $('header').removeClass('sticky');
        }
    });

    //*** Menu Js ***//
    $(document).on("click", '.menu-action', function () {
        $('.menu-list').toggleClass('open');
    });
    $(document).on("click", '.close-menu', function () {
        $('.menu-list').removeClass('open');
    });

    //*** BACK TO TOP START ***//
    $(window).scroll(function () {
        if ($(window).scrollTop() > 450) {
            $('.scroll-top').addClass('show');
        } else {
            $('.scroll-top').removeClass('show');
        }
    });
    $(document).ready(function () {
        $(document).on("click", '.scroll-top', function () {
            $('html, body').animate({scrollTop: 0}, '450');
        });
    });

    //*** WOW Js ***//
    new WOW().init();
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\condtruction-system\resources\views/layouts/landing.blade.php ENDPATH**/ ?>