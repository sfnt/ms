<?php
class ImageListController extends Controller{
    public function actionIndex(){
        $path = "D:".DIRECTORY_SEPARATOR."document".DIRECTORY_SEPARATOR."pictures".DIRECTORY_SEPARATOR."LG-E900".DIRECTORY_SEPARATOR."camare";
        //echo dirname(__FILE__);exit;
        if(!is_dir($path)){
            echo 'error';
            exit;
        }
        $dir = dir($path);
        $files = array();
        while($f=$dir->read()){
            $p=$path.DIRECTORY_SEPARATOR.$f;
            if((!is_dir($p)) AND ($f!=".") AND ($f!="..")){
                $files[] = $f;
            }
        }
        $dataProvider=new CArrayDataProvider($files, array(
                'keyField'=>false,
                'pagination'=>array(
                    'pageSize'=>100,
                ),
            ));
        $this->render('index',array('dataProvider'=>$dataProvider,'path'=>$path));
    }
    public function actionFile($file){
        $path = "D:".DIRECTORY_SEPARATOR."document".DIRECTORY_SEPARATOR."pictures".DIRECTORY_SEPARATOR."LG-E900".DIRECTORY_SEPARATOR."camare";
        if(file_exists($path.DIRECTORY_SEPARATOR.$file)){
            ImageHelper::getDiskFile($path.DIRECTORY_SEPARATOR.$file);
        }
        else{echo 'no file';}
    }
}
?>