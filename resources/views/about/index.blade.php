@extends('layouts.app')

@section('title', '| Om Mig')

@section('stylesheets')

    <meta name="description" content=""/>

    <style type="text/css">
        @import url(https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css);body{position:relative!important;color:#3d4451;font-family:"Open Sans",sans-serif;font-size:16px;line-height:1.5!important;background-color:#efefef}body::before{content:"";display:block;top:0;left:0;right:0;position:absolute;background:url('storage/thumbnail/{{ $about->bg }}') center center no-repeat;background-color:#242832;background-repeat:no-repeat;background-position:center;background-size:cover;height:440px}body::after{content:"";display:block;top:0;left:0;right:0;z-index:-2;position:absolute;background-color:#242832;height:440px;opacity:.9}.section-txt-btn{color:#000;font-size:20px;font-weight:300;line-height:1.8;text-align:center;margin-top:30px}.section-txt-btn .btn{padding:21px 55px;letter-spacing:.05em;margin:5px}.section-text .section-box p:last-child,.section-txt-btn p:last-child{margin-bottom:0}.section-about{padding-top:40px;position:relative}.section-about .section-text-btn{padding-left:5%;padding-right:5%}.section-about .section-box{padding:0;background-color:#fff;box-shadow:0 1px 6px rgba(0,0,0,.12),0 1px 4px rgba(0,0,0,.24)}.section-about .profile{padding:57px 50px 15px 50px}.section-about .profile-photo{margin-right:10%;margin-bottom:10px}.section-about .profile-info{color:#3d4451;padding-bottom:25px;margin-bottom:25px;border-bottom:1px solid #dedede}.section-about .profile-title_t{font-size:36px;line-height:1.1;font-weight:700;margin-bottom:5px;clear:both}.section-about .profile-title_t span{font-weight:300}.section-about .profile-position{font-size:18px;font-weight:400;line-height:1.1;margin-bottom:0}.profile-photo{position:relative;cursor:pointer}.profile-photo img{width:100%;display:block}.profile-photo .photo-hover{position:absolute;left:0;top:0;width:100%;height:100%;opacity:0;visibility:hidden;transition:opacity .2s ease-out,visibility .2s ease-out}.profile-photo:hover .photo-hover{opacity:1;visibility:visible}.profile-items{margin-bottom:18px}.profile-preword{float:left;margin-bottom:10px}.profile-preword span{background-color:#07aaf5;color:#fff;font-size:14px;font-weight:700;line-height:1.1;display:inline-block;padding:7px 12px;text-transform:uppercase;position:relative}.profile-preword span:before{content:'';width:0;height:0;top:100%;left:5px;display:block;position:absolute;border-style:solid;border-width:0 0 8px 8px;border-color:transparent;border-left-color:#07aaf5}#profileShareClose .rsicon{line-height:38px}.profile-share-list li{display:inline-block;margin:10px}.profile-share-list a{display:inline-block;width:50px;height:50px;line-height:50px;font-size:26px;color:#fff!important;background-color:#1f1f1f;-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%;-webkit-transition:opacity 250ms ease-out;-moz-transition:opacity 250ms ease-out;transition:opacity 250ms ease-out}.profile-share-list a:hover{text-decoration:none;opacity:.8}.profile-share-list .rsicon-facebook{background-color:#2d5f9a}.profile-share-list .rsicon-pinterest{background-color:#be1e2d}.profile-share-list .rsicon-twitter{background-color:#00c3f3}.profile-share-list .rsicon-youtube{background-color:#b00}.profile-list{margin:0;padding:0;list-style:none}.profile-list li{margin-bottom:13px}.profile-list .title_t{display:block;width:120px;float:left;color:#333;font-size:12px;font-weight:700;line-height:20px;text-transform:uppercase}.profile-list .cont{display:block;margin-left:125px;font-size:15px;font-weight:400;line-height:20px;color:#9da0a7}.profile-list .cont a{color:inherit}.profile-list .cont.profile-vacation{font-size:14px}.profile-list .button{background-color:#07aaf5;color:#fff;font-size:12px;font-weight:700;line-height:1;text-transform:none;padding:5px 8px;display:inline-block;position:relative;top:-2px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}.profile-list .rsicon{margin-right:10px;vertical-align:baseline}.profile-social{padding:15px 0;background-color:#07aaf5;height:80px}.list-inline-item-s{display:inline-flex;color:#fff}.list-inline-item a i{color:#fff}.section-about{width:70%}@media (max-width:992px){.section-about{width:100%}.section-about .profile{padding:50px 40px 15px 40px}.section-about .profile-photo{margin-right:0;margin-bottom:30px}}@media (max-width:767px){#profileShareClose{top:-60px;right:0}.section-about{padding-top:0}.section-about .profile{padding:30px 20px 15px 20px}.section-about .profile-photo{max-width:400px;margin-left:auto;margin-right:auto}.profile-info{text-align:center}.profile-preword{float:none}.profile-preword span{min-width:150px;padding:9px 12px}.profile-list .cont,.profile-list .title_t{width:100%;float:none;line-height:1.2}.profile-list .title_t{margin-bottom:3px}.profile-list .cont{margin-left:0;margin-bottom:15px}}@media (max-width:480px){.section-about .row>div{width:100%}.section-about .profile-title_t{font-size:28px}}.social{text-align:center;margin:0;padding:0}.social li{margin:5px 15px}.social li a{margin-left:10px;width:45px;height:45px;position:relative;display:inline-block;background-color:transparent;-webkit-transition:-webkit-transition,background-color .25s linear 0s;-moz-transition:-moz-transition,background-color .25s linear 0s;transition:transition,background-color .25s linear 0s;-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;backface-visibility:hidden;-webkit-border-radius:50%;-moz-border-radius:50%;border-radius:50%}.social li a:hover{text-decoration:none;background-color:rgba(0,0,0,.1)}.social li a i{color:#fff;line-height:2.3;font-size:20px}
    </style>
@endsection

@section('content')
    <div class="columns is-marginless is-centered">
        <section id="about" class="section section-about">
            <div class="column">
                <div class="section-box">
                    <div class="profile p-3 p-md-4 p-lg-5">
                        <div class="columns">
                            <div class="column is-5">
                                <div class="profile-photo mw-100">
                                    <img alt=""
                                         src="https://scontent-lht6-1.xx.fbcdn.net/v/t1.0-9/13769580_10209976018456089_2318929381628325192_n.jpg?_nc_cat=111&_nc_ohc=_EgK6oPMJK4AQmvpZB6IAhKytkMQlWShpT9inD0iKxA7i7KmwiRol0ZYQ&_nc_ht=scontent-lht6-1.xx&oh=bcc20c780ed4ab3f5018788ba333be0a&oe=5E8C30A5"
                                         class="img-fluid photo">
                                </div>
                            </div>
                            <div class="column is-7">
                                <div class="profile-info">
                                    <div class="profile-items clearfix">
                                        <div class="profile-preword"><span>Velkommen</span></div>
                                    </div>
                                    <h1 class="profile-title_t">
                                        <span>Jeg hedder</span>
                                        Britt Wittrup
                                    </h1>
                                    <h2 class="profile-position">Blogger</h2></div>
                                <ul class="profile-list">
                                    <li class="clearfix">
                                        <strong class="title_t">Sted</strong>
                                        <span class="cont">Virum, Danmark</span>
                                    </li>
                                    <li class="clearfix">
                                        <strong class="title_t">Sprog</strong>
                                        <span class="cont">Dansk, Engelsk, um pouco portugues</span>
                                    </li>
                                    <li class="clearfix">
                                        <strong class="title_t">E-mail</strong>
                                        <span class="cont">admin@loveofportugal.com</span>
                                    </li>
                                    <li class="clearfix">
                                        <strong class="title_t">Favoritrejsemål i Portugal</strong>
                                        <span class="cont">Porto, Azorerne</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="profile-social">
                        <ul class="social list-inline social-icons icon-circle ">
                            <li class="list-inline-item-s">
                                <a href="https://www.facebook.com/Love-of-Portugal-2229070847174497/" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.instagram.com/love_of_portugal/" target="_blank"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section-txt-btn">
                    <p>{!! $about->desc !!}</p>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
@endsection
