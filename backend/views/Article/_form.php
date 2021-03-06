<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\User;
use dosamigos\datepicker\DatePicker;
use backend\models\Categorie;
// use backend\model\CHtml;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form" style="width : 95%;">
    <div class="box-header with-border">
    <section class="content">    
<!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              
             
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'titre')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'contenu')->textarea(['rows' => 6]) ?>

                
                 <?= $form->field($model, 'publie')->dropDownList(
                     array(['1'=>'Oui', '0' => 'Non', '9' => 'Supprimé'])
                 ); 
                 // ['prompt' => 'Publier ?']
                 ?>

                <?= $form->field($model, 'file')->fileInput() ?>

                <?php  
                    $modelCats = ArrayHelper::map($modelCats, 'categorie', 'categorie');    
                ?>

                <?php if(empty($_GET['id'])) { ?>
                    <?= $form->field($model, 'categories')->checkboxlist($modelCats);

                     ?>
                    
                <?php 
                }else{ 
                    foreach ($modelCats as $key => $value) {
                        $categorie = Categorie::find()
                          ->where(['categorie' => $value])
                          ->one(); 
                        // var_dump($categorie);
                        echo $form->field($model, 'categories[]')
                                  ->checkbox([
                                    'label'=>$categorie->categorie,
                                    'value'=>$categorie->id_cat,
                                    'checked'=>true
                                  ])
                                  ->label(false);
                    }      
                }

                ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        </section>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

   
    </div> 
</div>


