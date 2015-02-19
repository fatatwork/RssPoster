<?php 
session_start();
$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
$user = json_decode($s, true);
if(isset($user)){
$_SESSION['user']=$user;
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$network = $user['network'];
$identity = $user['identity'];
setcookie('first_name', $first_name, time()+604800);
setcookie('last_name', $last_name, time()+604800);
setcookie('network', $network, time()+604800);
setcookie('identity', $identity, time()+604800);
}
 ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>���� ���� ���������� �� ������ ������������!</title>
    <meta name="DESCRIPTION" content="����������� ��������������� ����������� ����������� - ������� ������ ����������� ������� ���������� ���������� ��������, ������� ����������� ������������� ��������� � ���������. �� �������� ������������ ��������� 7046 ���������, 68 ���������� � 286 ����������� �����������, � ��� ����� 808 ����������� ��������� � 74 ����������� ����������� ����������.">
    <meta name="KEYWORDS" content="�������������������, ����, ����������� ��������������� ����������� �����������, �����������, ���, �����, �����������, ������ �����������, ��, ���������������� ������������, ����������, �������, �����, �����������, �����������, ����">
    <meta name="ROBOTS" content="all">
    <meta http-equiv="X-UA-Compatible" content="IE=9">

    <meta http-equiv="Content-Type" content="text/html; CHARSET=windows-1251">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700&subset=cyrillic-ext" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="http://www.bsmu.by/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="http://www.bsmu.by/scripts/upper.js"></script>
    <link rel="stylesheet" type="text/css" href="http://www.bsmu.by/style_main_ru.css">
    <link rel="stylesheet" type="text/css" href="http://www.bsmu.by/style_ru.css">

    <link href="http://www.bsmu.by/rss/rss.xml" rel="alternate" type="application/atom+xml" title="Atom 1.0" />
    <link rel="SHORTCUT ICON" href="/favicon.ico">

    <!--[if lt IE 9]>


    <link rel="stylesheet" type="text/css" href="/style_IE.css" media="all"></link>

    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

</head>
<body>

    <div id="naviP">
        <div class="defaultP" id="menuP">
            <ul>
                <li><a href="http://www.bsmu.by/">�������</a></li>
                <li><a href="http://www.bsmu.by/page/6/44/">�����������</a></li>
                <li><a href="http://www.bsmu.by/page/4/33/">����������</a></li>
                <li><a href="http://www.bsmu.by/page/3/32/">�������</a></li>
                <li><a href="http://www.bsmu.by/page/5/40/">���������</a></li>
                <li><a href="http://www.bsmu.by/page/8/64/">����</a></li>
                <li><a href="http://www.bsmu.by/qa/">������/�����</a></li>
            </ul>
        </div>
    </div>
    <div id="Header_cont">
        <div id="Logo"><a title="������� ��������" href="http://www.bsmu.by/"></a></div>
        <div id="Search">
            <div id="l_box1">
                <a class="op_box1">Languages</a><span style="color: #a5a5a5;"> &nbsp;&rarr;&nbsp;Rus</span>
                <div id="underlay1"></div>
                <div id="lightbox1">
                    <br /><a class="cl_box1" href="#">x</a>
                    <div id="sl"><span style="color: #c5c5c5;"><strong>Supporting languages</strong></span></div>
                    <div id="Lang">&nbsp;&nbsp;<a href="http://eng.bsmu.by/">Eng</a>&nbsp; <a href="http://spa.bsmu.by/">Spa</a>&nbsp; <a href="http://deu.bsmu.by/">Deu</a>&nbsp; <a href="http://ara.bsmu.by/">Ara</a>&nbsp; <a href="http://fra.bsmu.by/">Fra</a>&nbsp; <a href="http://tuk.bsmu.by/">Tuk</a>&nbsp; <a href="http://fas.bsmu.by/">Fas</a>&nbsp; <a href="http://aze.bsmu.by/">Aze</a>&nbsp; <a href="http://chi.bsmu.by/">Chi</a>&nbsp; <a href="http://heb.bsmu.by/">Heb</a>&nbsp;</div>
                </div>
            </div>
            <form name="frmsearch" class="search" method=GET action="http://www.bsmu.by/search/">
                <div><input class=search_input name=words maxlength=120 value=''><input type=image class=search_image title="�����" alt="�����" src="http://www.bsmu.by/design/search_ru.gif"></div>
            </form> <a href="http://www.bsmu.by/map/">����� �����</a>
        </div>
    </div>
    <div class="niled">&nbsp;</div>
    <div class="Collage">
        <div class="Collage_In"><img src="http://www.bsmu.by/design/kollazh_empty.gif" alt="" /></div>
    </div>
    <div class="Content_cont">
        <script src="http://www.bsmu.by/scripts/jquery-ui-1.8.18.custom.min.js"></script>
        <script src="http://www.bsmu.by/scripts/jquery.smooth-scroll.min.js"></script>
        <script src="http://www.bsmu.by/scripts/photo.js"></script>
        <div class="MenuMainIn">
            <h1>�������</h1>
            <div class="news_headings"><a href="http://www.bsmu.by/allarticles/rubric1/">�������������������</a> <a href="http://www.bsmu.by/allarticles/rubric2/">�������������</a> <a href="http://www.bsmu.by/allarticles/rubric3/">�������</a> <a href="http://www.bsmu.by/allarticles/rubric4/">��������������</a> <a class="LentaRSS" href="http://www.bsmu.by/rss/rss.xml">RSS</a></div>
            <div class="niled">&nbsp;</div>
        </div>
        <div class="OtherPages OtherPagesQNP">
            <p><div class=path><font size="1" color="#a50000">&rarr;</font> <a href="http://www.bsmu.by">�������</a> <font size="1" color="#a50000">&rarr;</font> <a href="http://www.bsmu.by/allarticles/">�������</a> <font size="1" color="#a50000">&rarr;</font> <a href="http://www.bsmu.by/allarticles/rubric1/">�������������������</a></div></p>
            <div class="NewsContent">
                <span style="font-family: helvetica; color: #747474; font-size: 30px;">17</span><span style="font-family: helvetica; font-size: 11px; color: #747474;"> ������� 2015 �.</span>
                <h1>���� ���� ���������� �� ������ ������������! ������������ ������������ ���� � ������ �������� ���� ������� ���������.</h1>
                <p><img src="http://www.bsmu.by/ImgForArticles/201502171431371.jpg" alt="���� ���� ���������� �� ������ ������������!"></p>
                <p><p>������������ ������������ ���� � ������ �������� ���� ������� ���������. ��������������� ���-��������� � �����, ��������� � ������� ���� ������������ ������� � ���� �������� �������. ��������� �� ������ �������������� ���������� ������������, �� � ���� ���� ������ &ndash; ������� �������� &laquo;���������&raquo; ������� ����� � 101 � ������� ��������� ������ &laquo;����&raquo; ������� ����� � 161. ������������ ������� ����������� �������� � ����� �������� &ndash; ������� ����� ���������.</p>
                <p>
                    <div class='album' alt='���� ���� ���������� �� ������ ������������!' name='album620'>
                        <div class='alb_cont' id='alb_cont620'>
                            <div id='btn_left' class='btn_left_noactive'>&nbsp;</div>
                            <div class='album_box' id='album_box620'><div class='album_img' id='album_img620' alt='���� ���� ���������� �� ������ ������������!'><a href='http://www.bsmu.by/PhotoAlbums/201502171404072.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_201502171404072.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/201502171405503.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_201502171405503.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/201502171407384.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_201502171407384.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/201502171412075.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_201502171412075.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/201502171414356.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_201502171414356.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/201502171416537.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_201502171416537.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/201502171418188.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_201502171418188.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/201502171421019.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_201502171421019.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/2015021714224910.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_2015021714224910.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/2015021714263111.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_2015021714263111.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/2015021714284112.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_2015021714284112.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/2015021714300013.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_2015021714300013.jpg' width='150' height='100'></a><a href='http://www.bsmu.by/PhotoAlbums/2015021714311414.jpg' rel='lightbox[album620]' title='' class='pre'><img src='http://www.bsmu.by/PhotoAlbums/s_2015021714311414.jpg' width='150' height='100'></a></div></div><div id='btn_right' class='btn_right_active' alt='13'>&nbsp;</div>
                        </div>
                        <script type='text/javascript'>
                            Album_pre['album620'] = [13];
                        </script>
                    </div><div style='clear:both;'></div>
                </p>
                <p>���� ���������� ���������� ��������� �� �������������� ������ ������� �������� ������������� � ����������� ��������� ������ ����������� �������������� � ���������� ������ ������� ����������� ���������������� ������������ ������������ ��. �.�. �������� ������� ������� ���������, ������� ��������� � ������������ � ����������� �������.</p>
                <p><em>�������� ���� ��� ����� �������</em></p></p>
                <br />
                <!-- ����� ������������ ������ -->
                <script src="//ulogin.ru/js/ulogin.js"></script>
                <div id="uLogin" data-ulogin="display=small;fields=first_name,last_name;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri=http%3A%2F%2Fbsmu.akson.by%2Flove.php"></div>
                
                <form class="comments" method="POST" action="sample.php">
                   <textarea name="user_comment" cols="50" rows="10"></textarea>
                <input type="submit"/>
                </form>
                <script charset="utf-8" src="http://yandex.st/share/share.js" type="text/javascript"></script>
                <!--<div data-yasharel10n="ru" data-yasharetype="none" data-yasharequickservices="facebook,twitter,vkontakte,odnoklassniki,moimir,lj,gplus,yaru,friendfeed,moikrug" class="yashare-auto-init"></div>-->
            </div>
            <div class="AnonsOther">
                <p>

                    <div class="AnonsArtRubric">
                        <div class="In"><a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article989/"><img src="http://www.bsmu.by/ImgForArticles/s_201502171247581.jpg" alt="������� � ��������� �� ����������� �������."></a></div>
                        <div class="InText">
                            <div><span style="font-size: 18px;">16</span> �������</div>
                            <a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article989/">������� � ��������� �� ����������� �������.</a><br />���������� �������� ����������� � ����.
                        </div>
                    </div>
                    <div class="niled">&nbsp;</div>

                    <div class="AnonsArtRubric">
                        <div class="In"><a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article992/"><img src="http://www.bsmu.by/ImgForArticles/s_201502171602131.jpg" alt="VI ������������� ������������ ����������������� ��������� � ������������� ��������"></a></div>
                        <div class="InText">
                            <div><span style="font-size: 18px;">13</span> �������</div>
                            <a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article992/">VI ������������� ������������ ����������������� ��������� � ������������� ��������</a><br />- 2015.
                        </div>
                    </div>
                    <div class="niled">&nbsp;</div>

                    <div class="AnonsArtRubric">
                        <div class="In"><a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article988/"><img src="http://www.bsmu.by/ImgForArticles/s_201502161519072.jpg" alt="�������� ������������������ �����������."></a></div>
                        <div class="InText">
                            <div><span style="font-size: 18px;">13</span> �������</div>
                            <a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article988/">�������� ������������������ �����������.</a><br />������� �� ����������������� ��������� ������ ������� �������.
                        </div>
                    </div>
                    <div class="niled">&nbsp;</div>

                    <div class="AnonsArtRubric">
                        <div class="In"><a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article986/"><img src="http://www.bsmu.by/ImgForArticles/s_201502121103421.jpg" alt="�������� ����������� ����������� ��������� ����������� ����������� ���������"></a></div>
                        <div class="InText">
                            <div><span style="font-size: 18px;">12</span> �������</div>
                            <a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article986/">�������� ����������� ����������� ��������� ����������� ����������� ���������</a><br />����.
                        </div>
                    </div>
                    <div class="niled">&nbsp;</div>

                    <div class="AnonsArtRubric">
                        <div class="In"><a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article984/"><img src="http://www.bsmu.by/ImgForArticles/s_201502111420041.jpg" alt="������ ������������� ������������ � ����������� ����������"></a></div>
                        <div class="InText">
                            <div><span style="font-size: 18px;">11</span> �������</div>
                            <a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article984/">������ ������������� ������������ � ����������� ����������</a><br />���������� �������� ����������� �������� ��������.
                        </div>
                    </div>
                    <div class="niled">&nbsp;</div>

                    <div class="AnonsArtRubric">
                        <div class="In"><a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article980/"><img src="http://www.bsmu.by/ImgForArticles/s_201501291343291.jpg" alt="������ ���������� ����������� 2014 ����"></a></div>
                        <div class="InText">
                            <div><span style="font-size: 18px;">29</span> ������</div>
                            <a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article980/">������ ���������� ����������� 2014 ����</a><br />�� ����������� ������ � ���������� ��������.
                        </div>
                    </div>
                    <div class="niled">&nbsp;</div>

                    <div class="AnonsArtRubric">
                        <div class="In"><a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article979/"><img src="http://www.bsmu.by/ImgForArticles/s_201501281529091.jpg" alt="����������� �� ���������� �������� ���������� � ����������� � ������ ������� ������ ����,"></a></div>
                        <div class="InText">
                            <div><span style="font-size: 18px;">28</span> ������</div>
                            <a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article979/">����������� �� ���������� �������� ���������� � ����������� � ������ ������� ������ ����,</a><br />����������� 85-����� ������������ �.�.
                        </div>
                    </div>
                    <div class="niled">&nbsp;</div>

                    <div class="AnonsArtRubric">
                        <div class="In"><a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article978/"><img src="http://www.bsmu.by/ImgForArticles/s_201501271449353i270114.jpg" alt="����������� �������� ����"></a></div>
                        <div class="InText">
                            <div><span style="font-size: 18px;">27</span> ������</div>
                            <a title="��������� �������" href="http://www.bsmu.by/allarticles/rubric1/article978/">����������� �������� ����</a><br />�� ���� ������������  �������.
                        </div>
                    </div>
                    <div class="niled">&nbsp;</div>

                </p>
            </div>
        </div>
        <script src="http://www.bsmu.by/scripts/title.js" type="text/javascript"></script>
    </div>
    <div class="niled">&nbsp;</div>
    <div id="Footer_cont">
        <div id="goverment">
            <div id="blazon"><img src="http://www.bsmu.by/design/gerb_rgb.jpg" alt="" /></div>
            <div class="govermentbox">
                <div>��������� ���������� ��������</div>
                <a href="http://president.gov.by">president.gov.by</a>
            </div>
            <div class="govermentbox">
                <div>����� ���������� ��������</div>
                <a href="http://sovrep.gov.by">sovrep.gov.by</a>
            </div>
            <div class="govermentbox">
                <div>������������ ���������������</div>
                <a href="http://minzdrav.gov.by">minzdrav.gov.by</a>
            </div>
            <div class="govermentbox">
                <div>������������ �����������</div>
                <a href="http://edu.gov.by">edu.gov.by</a>
            </div>
        </div>
        <div class="niled">&nbsp;</div>
        <div id="copyright1">&copy; 1921&mdash;2015 ���������� ����������� &laquo;����������� ��������������� ����������� �����������&raquo;.</div>
        <div id="copyright2">��� ����������� ��������� ���������� � ����������&nbsp;����������� �� ���� �����������. ��� ����� �� ����������� � ��������� ��������� ����������� �� �������.</div>
        <div class="niled">&nbsp;</div>
        <div id="footerinfo">
            <a href="http://www.bsmu.by/page/18/1481/">���������� ����������</a>
            <p>220116, �. �����, ��. ������������, 83<br />���: +375 17 272-61-96. ����: +375 17 272-61-97<br />��. �����: <a href="mailto:bsmu@bsmu.by">bsmu@bsmu.by</a><br /><br /></p>
        </div>
        <div class="banner_Partn">
            <p><img src="http://www.bsmu.by/images/MainPage/part_m.png" alt="" width="22" height="22" /><br /><a href="http://belodent.org/">����������������� �������������-��������������� ������ belodent.org</a><br /><a title="��������� ��������������� ������ ������ ������� ����������� ����������" href="http://www.vsmu.by/ru/">����</a> <a title="��������� ��������������� ����������� ��. �. �. ��������" href="http://www.vsu.by/index.php/ru/">���</a> <a title="����������� ��������������� ����������� �����������" href="http://grsmu.by/">�����</a> <a title="����������� ��������������� ����������� ����������� � ����������������" href="http://www.bsuir.by/">�����</a>&nbsp;<a title="����������� ��������������� ����������� ����� ���� ������" href="http://www.grsu.by/">����</a> <a title="������� ������������� �����������" href="http://www.miu.by/">���</a> <a title="��������� ��������������� ����������� ����� �.�. �������" href="http://brsu.by/">����</a> <a title="���������� ��������������� ����������� ����������� ����� �.�. ������" href="http://gstu.by/">����</a> <a title="�������� ���������� ��� ���������� ���������� ��������" href="http://pac.by/">������</a> <a title="����������� ��������������� ����������� ����� �.�. ��������" href="http://msu.mogilev.by/">���</a> <a title="������������� ��������������� �����������" href="http://barsu.by/">�����</a></p>
            <p><a href="http://www.alexa.com/"><img src="http://www.bsmu.by/images/MainPage/alexa.jpg" alt="" width="60" height="56" /></a></p>
        </div>
    </div>
    <script src="http://www.bsmu.by/scripts/menu.js" type="text/javascript"></script>
    <script src="http://www.bsmu.by/scripts/lang_box.js" type="text/javascript"></script>
</body>
</html>