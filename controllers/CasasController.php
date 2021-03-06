<?php

namespace app\controllers;

use Yii;
use app\models\Casa;
use app\models\Cozinha;
use app\models\Quarto;
use app\models\Sala;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CasaController implements the CRUD actions for Casa model.
 */
class CasasController extends ActiveController
{
    public $modelClass = 'app\models\Casa';


    public function actionDetalhes($id){

        $casa = Casa::findOne(['id' => $id]);

        if($casa != null){

            return ['Casa' => [
                'ID' => $casa->id,
                'ID_Proprietário' => $casa->id_proprietario,
                'Nome_rua' => $casa->nome_rua,
                'Tipo_alojamento' => $casa->tipo_alojamento,
                'Capacidade' => $casa->capacidade,
                'Area_exterior' => $casa->area_exterior,
                'Num_quartos' => $casa->num_quartos,
                'Num_wcs' => $casa->num_wcs,
                'Wifi' => $casa->wifi,
                'Limpeza' => $casa->limpeza,
                'Aquecimento_agua' => $casa->aquecimento_agua,
                'Animais' => $casa->animais,
                'Fumar' => $casa->fumar,
                'Visitantes_pernoitar' => $casa->visitantes_pernoitar,
            ]];
        } else {
            throw new \yii\web\NotFoundHttpException("A casa não foi encontrada");
        }
    }

    public function actionApagar($id){
        $casamodel = new $this->modelClass;

        $rec = $casamodel->deleteAll("id=".$id);

        if($rec)
            return ['DelError' => $rec];

        throw new \yii\web\NotFoundHttpException("Id da casa não encontrado");
    }

    public function actionRegistos($n_registos){
        $casamodel = new $this->modelClass;

        $recs = $casamodel::find()->limit($n_registos)->all();

        return ['limite' => $n_registos, 'Records' => $recs];
    }

    public function actionCozinha($id){

        $cozinha = Cozinha::findOne(['id' => $id]);

        return $cozinha;
    }

    public function actionQuarto($id){

        $quarto = Quarto::findOne(['id' => $id]);

        return $quarto;
    }

    public function actionSala($id){

        $sala = Sala::findOne(['id' => $id]);

        return $sala;
    }
}
