<?php

namespace app\controllers;

use app\models\Casa;
use app\models\Cozinha;
use app\models\Quarto;
use app\models\Sala;
use Yii;
use yii\rest\ActiveController;
use app\models\Anuncio;


/**
 * AnuncioController implements the CRUD actions for Anuncio model.
 */
class AnunciosController extends ActiveController
{
    public $modelClass = 'app\models\Anuncio';

    public function actionDetalhes($id)
    {
        $anuncio = Anuncio::findOne(['id' => $id]);


        if($anuncio != null){

            return ['Anuncio' => [
                'id_proprietario' => $anuncio->id_proprietario,
                'id_casa' => $anuncio->id_casa,
                'titulo' => $anuncio->titulo,
                'preco' => $anuncio->preco,
                'data_criacao' => $anuncio->data_criacao,
                'data_disponibilidade' => $anuncio->data_disponibilidade,
                'despesas_inc' => $anuncio->despesas_inc,
                'descricao' => $anuncio->descricao,
                'numero_telemovel' => $anuncio->numero_telemovel,
            ]];
        } else {
            throw new \yii\web\NotFoundHttpException("O utilizador não foi encontrado");
        }
    }

    public function actionAlterar($id)
    {
        $titulo=\Yii::$app->request->post('titulo');
        $preco=\Yii::$app->request->post('preco');
        $data_disponibilidade=\Yii::$app->request->post('data_disponibilidade');
        $despesas_inc=\Yii::$app->request->post('despesas_inc');
        $descricao=\Yii::$app->request->post('descricao');
        $numero_telemovel=\Yii::$app->request->post('numero_telemovel');

        $anunciomodel = new $this->modelClass;

        $rec = $anunciomodel::find()->where("id=".$id)->one();

        if($rec){
            $rec->titulo=$titulo;
            $rec->preco=$preco;
            $rec->data_disponibilidade=$data_disponibilidade;
            $rec->despesas_inc=$despesas_inc;
            $rec->descricao=$descricao;
            $rec->numero_telemovel=$numero_telemovel;

            $rec->save();

            return['SaveError'=> $rec];
        }
        throw new \yii\web\NotFoundHttpException("Id de anúncio não encontrado");
    }

    public function actionApagar($id){
        $anunciomodel = new $this->modelClass;

        $rec = $anunciomodel->deleteAll("id=".$id);

        if($rec)
            return ['DelError' => $rec];

        throw new \yii\web\NotFoundHttpException("Id de anúncio não encontrado");
    }

    public function actionAdicionar(){

        $id_proprietario=\Yii::$app->request->post('id_proprietario');
        $id_casa=\Yii::$app->request->post('id_casa');
        $titulo=\Yii::$app->request->post('titulo');
        $preco=\Yii::$app->request->post('preco');
        $data_criacao=\Yii::$app->request->post('data_criacao');
        $data_disponibilidade=\Yii::$app->request->post('data_disponibilidade');
        $despesas_inc=\Yii::$app->request->post('despesas_inc');
        $descricao=\Yii::$app->request->post('descricao');
        $numero_telemovel=\Yii::$app->request->post('numero_telemovel');

        $anunciomodel = new $this->modelClass;

        $anunciomodel->id_proprietario=$id_proprietario;
        $anunciomodel->id_casa=$id_casa;
        $anunciomodel->titulo=$titulo;
        $anunciomodel->preco=$preco;
        $anunciomodel->data_criacao=$data_criacao;
        $anunciomodel->data_disponibilidade=$data_disponibilidade;
        $anunciomodel->despesas_inc=$despesas_inc;
        $anunciomodel->descricao=$descricao;
        $anunciomodel->numero_telemovel = $numero_telemovel;

        $rec = $anunciomodel->save();
        return ['SaveError' => $rec];
    }
}
