<?php
class LanguagePackageController extends ManagementController{
    public function actionIndex(){

        $sourceLanguage = Yii::app()->sourceLanguage;
        $currentLanguage =  Yii::app()->language;
        
        $basePath = Yii::app()->basePath.DIRECTORY_SEPARATOR.'messages';
        $dir = dir($basePath);
        $languages = array();
        while($f=$dir->read()){
            $p=$basePath.DIRECTORY_SEPARATOR.$f;
            if((is_dir($p)) AND ($f!=".") AND ($f!="..")){

                $languages[] = $f;
            }
        }
        $files = array();
        
        if(in_array($currentLanguage,$languages)){
            $dir = dir($basePath.DIRECTORY_SEPARATOR.$currentLanguage);
            while($f=$dir->read()){
                $p=$basePath.DIRECTORY_SEPARATOR.$currentLanguage.DIRECTORY_SEPARATOR.$f;
                if((!is_dir($p)) AND ($f!=".") AND ($f!="..")){
                    $files[] = $f;
                }
            }
        }
        $this->render('index',array(
           'languages'=>$languages,
           'basePath'=>$basePath,
           'sourceLanguage'=>$sourceLanguage,
           'currentLanguage'=>$currentLanguage,
           'files'=>$files,
        ));
    }
    public function actionUpdate($file,$selectedLan){
        $sourceLanguage = Yii::app()->sourceLanguage;
        $currentLanguage =  Yii::app()->language;
        $basePath = Yii::app()->basePath.DIRECTORY_SEPARATOR.'messages';
        $fileContent = include($basePath.DIRECTORY_SEPARATOR.$selectedLan.DIRECTORY_SEPARATOR.$file);
        $baseContent = include($basePath.DIRECTORY_SEPARATOR.$currentLanguage.DIRECTORY_SEPARATOR.$file);
        //print_r($baseContent);exit();
        if(isset($_POST['trans'])){
            $out = "<?php\n";
            $out .= 'return ';
            $out .= var_export($_POST['trans'],true);
            $out .= ";\n?>";
            //exit();
            $result = file_put_contents($basePath.DIRECTORY_SEPARATOR.$selectedLan.DIRECTORY_SEPARATOR.$file, $out);
            
            if($result!==false){
				Yii::app()->manager->setFlash('success',Yii::t('system','Save successfully.'));
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index','package'=>$selectedLan));
            }
			else{
				Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
            }
        }
        
        $this->render('update',array(
           'basePath'=>$basePath,
           'sourceLanguage'=>$sourceLanguage,
           'currentLanguage'=>$currentLanguage,
           'file'=>$file,
           'selectedLan'=>$selectedLan,
           'fileContent'=>$fileContent,
           'baseContent'=>$baseContent,
        ));
    }
}
?>