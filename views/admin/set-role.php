<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\Pjax;
    use app\models\forms\SetRoleForm;
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Hi there!</h1>

        <p class="lead"><b><?= $user->username ?></b> want to use our web services. </p>

        <p>Please set role for this user then accept this request</p>
    </div>

    <div class="body-content">
        <?php
        
        Pjax::begin([
            // Pjax options
        ]);
            $form = ActiveForm::begin([
                'options' => ['data' => ['pjax' => true]],
                'id' => 'submit-request'
                // more ActiveForm options
            ]);
                echo $form->field($model, 'role')->dropdownList($roles, ['prompt'=>'Select Role']);
                echo $form->field($model, 'requestIdentity')->hiddenInput(['value'=> $requestIdentity])->label(false);

                echo Html::submitButton('Confirm', ['class' => 'btn btn-primary', 'id' => 'submit-btn' ]);
            ActiveForm::end();
        Pjax::end();
        ?>
    </div>
</div>

<?php
$script = <<< JS
    $(function() {
        $('#submit-request').on('beforeSubmit', function (event, jqXHR, settings) {
            $("#submit-btn").prop('disabled', true);
        });
    });
JS;
$this->registerJs($script);
?>