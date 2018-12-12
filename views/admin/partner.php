<?php
    use yii\grid\GridView;
    use yii\grid\ActionColumn;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\assets\AppAsset;

    AppAsset::register($this);
    $this->title = 'Partners manager - List Master project';
?>

<div class="site-index">
    <div class="jumbotron">
        <h2>Partner management</h2>
    </div>

    <div class="body-content">
        <?php \yii\widgets\Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $usersData,
            'filterModel' => $searchModel,
            'columns' => [
                'username',
                'email',
                [
                    'label' => 'Role',
                    'attribute' => 'roleName',
                    'value' => 'role.name'
//                    'attribute' => 'role_id',
//                    'value' => function ($model) {
//                        return $model->role->name;
//                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'template' => '{update}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::label('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Update user\'s role'),
                                'class' => 'update-button',
                                'user-id' => $model->id,
                                'current-role' => $model->role_id,
                                'name' => $model->username,
                                'email' => $model->email,
                            ]);
                        },
                    ]
                ],
            ],
        ]) ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>

<?php
$script = <<< JS
    $(function() {
        $(".update-button").click(function (e){
            var userId = $(e.currentTarget).attr("user-id");
            var roleId = $(e.currentTarget).attr("current-role");
            var name = $(e.currentTarget).attr("name");
            var email = $(e.currentTarget).attr("email");
            var deleteUrl = document.location.origin + "/admin/remove-test/" + userId;
            $(".role-requestIdentity").val(userId);
            $("#setroleform-role").val(roleId);
            $(".role-name").val(name);
            $(".role-email").val(email);
            if (email.startsWith('dm4ctest.')) {
                $("#remove-btn").attr("href", "/admin/remove-test?id=" + userId);
                $("#remove-btn").show();
            } else {
                $("#remove-btn").hide();
            }
            $("#update-modal").modal();
        });
    });
    $(document).on('pjax:success', function() {
        $( ".update-button").unbind( "click" );
        $(".update-button").click(function (e){
            var userId = $(e.currentTarget).attr("user-id");
            var roleId = $(e.currentTarget).attr("current-role");
            var name = $(e.currentTarget).attr("name");
            var email = $(e.currentTarget).attr("email");
            var deleteUrl = document.location.origin + "/admin/remove-test/" + userId;
            $(".role-requestIdentity").val(userId);
            $("#setroleform-role").val(roleId);
            $(".role-name").val(name);
            $(".role-email").val(email);
            if (email.startsWith('dm4ctest.')) {
                $("#remove-btn").attr("href", "/admin/remove-test?id=" + userId);
                $("#remove-btn").show();
            } else {
                $("#remove-btn").hide();
            }
            $("#update-modal").modal();
        });
    });
JS;
$this->registerJs($script);
?>

    <div id="update-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <?php
                    $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => ['class' => 'form-horizontal'],
                    ]) 
                ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <?= 
                        $form->field($model, 'requestIdentity')
                        ->hiddenInput([
                            'value'=> '',
                            'class'=> 'hidden role-requestIdentity'
                        ])
                        ->label(false); 
                    ?>
                    <?= Html::label('Name', 'name') ?>
                    <?= Html::textInput('name', '', [
                        'class' => 'form-control role-name',
                        'disabled' => 'disabled'
                    ]) ?>
                    <?= Html::label('Email', 'email') ?>
                    <?= Html::textInput('email', '', [
                        'class' => 'form-control role-email',
                        'disabled' => 'disabled'
                    ]) ?>
                    <?= $form->field($model, 'role')->dropdownList($roles, ['prompt'=>'Select Role'], [
                        'class' => 'form-control'
                    ]); ?>
                </div>
                <div class="modal-footer">
                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                    <?=
                        Html::a("Remove", "#", ['class' => 'btn btn-danger', 'id' => 'remove-btn']);
                    ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>