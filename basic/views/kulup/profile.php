<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 19.05.2020
 * Time: 00:02
 */

/* @var $etkinlikProvider yii\data\ActiveDataProvider */ //ListView::Widget'ı bu dataProvider ile besliyoruz, tüm etkinlikleri
//controller'da belirtilen ayarlarda gönderiyor.
/* @var $kulup app\models\Kulupler */                   //Kulup objesi
/* @var $faaliyetler */                                 //KulupFaaliyetAlanları, Array olarak

use yii\bootstrap4\LinkPager;
use yii\widgets\ListView;

?>

<div class="row mb-n5">
    <div class="col-12 ">
        <div class="bg-gradient-dark rounded" style="height: 60px;"></div>
    </div>
</div>
<div class="row mx-2 mb-3">
    <div class="col-md-9 col-12">
        <div class="card shadow-lg mb-md-0 mb-3 ">
            <div class="card-body">
                <h5 class="card-title mb-3">Hakkımızda</h5>
                <hr class="mt-0">
                <p class="card-text"><?php echo $kulup->amac ?></p>
                <h5 class="card-title">Faaliyet alanı</h5>
                <hr class="mt-0">
                <div class="row pl-2">
                    <!--Array içerisinde belirtilen faaliyet alanının olup olmadığı kontrol edilir ve ona göre
                        gerekli elemanları ekler.-->
                    <?php if (in_array("mesleki", $faaliyetler, true)) {
                        echo '<small>
                        <div class="rounded bg-primary px-2 py-1 m-1"><p class="my-0 text-white">Mesleki</p></div>
                    </small>';
                    }
                    if (in_array("bilimsel", $faaliyetler, true)) {
                        echo '<small>
                        <div class="rounded bg-success px-2 py-1 m-1"><p class="my-0 text-white">Bilimsel</p></div>
                    </small>';
                    }
                    if (in_array("kulturel", $faaliyetler, true)) {
                        echo '<small>
                        <div class="rounded bg-danger px-2 py-1 m-1"><p class="my-0 text-white">Kültürel</p></div>
                    </small>';
                    }
                    if (in_array("sanatsal", $faaliyetler, true)) {
                        echo '<small>
                        <div class="rounded px-2 py-1 m-1" style="background-color: #7A43B6;"><p
                                    class="my-0 text-white">Sanatsal</p></div>
                    </small>';
                    }
                    if (in_array("sportif", $faaliyetler, true)) {
                        echo '<small>
                        <div class="rounded px-2 py-1 m-1" style="background-color: #896A58;"><p
                                    class="my-0 text-white">Sportif</p></div>
                    </small>';
                    }
                    if (in_array("sosyal", $faaliyetler, true)) {
                        echo '<small>
                        <div class="rounded px-2 py-1 m-1" style="background-color: #d79228;"><p
                                    class="my-0 text-white">Sosyal</p></div>
                    </small>';
                    }
                    if (count($faaliyetler) == 0) {
                        echo '<small><p class="ml-2">Bu kulübün tanımlanmış faaliyet alanı bulunmamaktadır.</p></small>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12">
        <div class="ml-lg-auto">
            <div class="card mb-3 bg-gray-100 mx-auto shadow-lg border-0">
                <?php
                //TODO: Kullanıcının üyelik seviyesi, üye olup olmadığı burada kontrol edilerek, belirtilen alan özelleştirilir.
                //TODO: Örn. Kullanıcı başkan ise bu kutu içerisinde başkan yazar. Üyenin kulüpte ne olduğu. Hiçbiri değilse istek gönder.
                //TODO: İstek göndermiş ve bir şey değilse, istek beklemede.
                if (true) {
                    echo '<a class="card-body stretched-link rounded bg-success text-white text-decoration-none" href="">
                    <div class="my-auto text-center">Üyelik isteği gönder</div>
                </a>';
                } else {
                    echo '<div class="card-body rounded bg-secondary text-gray-400 text-decoration-none" href="">
                    <div class="my-auto text-center">İstek gönderildi</div>
                </div>';
                } ?>

            </div>
            <div class="card mb-3 bg-gray-100 mx-auto shadow-lg">
                <div class="card-body text-center">
                    <h1 class="text-dark font-weight-light mb-0"><?php echo $kulup->getKulupUyes()->count() ?></h1>
                    <h5 class="text-secondary font-weight-bold mt-0">Üye Sayısı</h5>
                </div>
            </div>
            <div class="card mb-3 bg-gray-100 mx-auto shadow-lg">
                <div class="card-body text-center">
                    <h1 class="text-dark font-weight-light mb-0"><?php echo $etkinlikProvider->count ?></h1>
                    <h5 class="text-secondary font-weight-bold mt-0">Etkinlik Sayısı</h5>
                </div>
            </div>


        </div>

    </div>
</div>
<div class="row mx-3 shadow-lg">
    <div class="card col-12">
        <div class="card-body p-xs-0">
            <div class="row mx-1 my-0">
                <h5 class="my-auto">Güncel Etkinlikler</h5>
                <a class="text-decoration-none ml-auto mr-2 my-auto" href="/events/?id=<?php echo $kulup->id ?>">Tümünü
                    gör</a>
            </div>
            <hr>
            <?php
            //Etkinlikleri listeleyen widget
            echo ListView::widget([
                'dataProvider' => $etkinlikProvider,
                'pager' => [
                    'class' => LinkPager::class,
                ],
                'itemView' => '/events/_etkinlik_item',
                'layout' => '<div class="card-deck">{items}</div><div class="d-flex justify-content-center">{pager}</div>',
                'itemOptions' => [
                    'tag' => false
                ],

            ]) ?>
        </div>
    </div>
</div>

