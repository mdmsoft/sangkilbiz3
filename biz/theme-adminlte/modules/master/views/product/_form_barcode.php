<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model biz\master\models\Product */
?>
<?=

GridView::widget([
    'dataProvider' => new ActiveDataProvider([
        'query' => $model->getBarcodes(),
        'sort' => false,
            ]),
    'tableOptions' => ['class' => 'table table-striped'],
    'layout' => '{items}',
    'showFooter' => true,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'footer' => Html::label('New','#barcode-alias')
        ],
        [
            'attribute' => 'barcode',
            'footer' => Html::textInput('barcode','',['style'=>'width:300px;','id'=>'barcode-alias']),
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'urlCreator' => function ($action, $child) use ($model) {
                return Url::toRoute(['delete-barcode', 'id_product' => $model->id_product, 'barcode' => $child->barcode]);
            }
        ]
    ],
]);
?>
<?php

$js = <<<JS
yii.global.isChangeOrEnter(\$(document),'#input-form [name="barcode"]',function () {
    \$('#input-form [name="action"]').val('barcode');
    \$('#input-form').submit();
});
JS;

$this->registerJs($js);
