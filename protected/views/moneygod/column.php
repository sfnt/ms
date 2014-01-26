<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/mg/css/moneygod.css','screen');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/mg/css/new_list.css','screen');
?>
<div class="centerDiv" style="margin-top:5px;">
	<div class="list_main">
        <div class="position">
<?php
$menus = Column::getArrayTree();
$breadcrumbMenus = array();
if(isset($this->params['columnid'])){
    $breadcrumbMenus = Column::getParentArr($this->params['columnid']);
}
?>
			<a href='/'>主頁</a>
<?php
    if($column){
        for($i=0;$i<=$column->level;$i++){
            if(isset($breadcrumbMenus[$i])){
                echo ' / ';
                echo CHtml::link($breadcrumbMenus[$i]['name'],array('column','id'=>$breadcrumbMenus[$i]['id']));
            }
        }
    }
?>
		</div>
        
<?php

    $criteria = new CDbCriteria();
    $criteria->condition = 'columnid=:columnid';
    //
    $criteria->params=array(':columnid'=>$column->id); 
    
    
    $childIds = Column::getChildIds($column->id);

    if($childIds){
        $criteria->condition .= ' OR (columnid in ('.$childIds.'))';
        $criteria->with=array('column');
    }
    
    $criteria->order='t.publishtime DESC,t.id ASC';  

    $dp = new CActiveDataProvider('Article',array(
        'criteria'=>$criteria,    
        'pagination'=>array(    
            'pageSize'=>50,    
        ), 
    ));
    
    //$model->status = 2;
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dp,
        'itemView'=>'_view',
        'viewData'=>array('columnid'=>$column->id),
        'ajaxUpdate'=>true,
        'template'=>'<div class="list_page"><div class="list" style="padding-bottom:10px;"><ul>{items}</ul></div></div>
        <div>{summary}{pager}</div>',
        'pagerCssClass'=>'pagelist',//定义pager的div容器的class
        'summaryText'=>'共{count}條，顯示第{start}-{end}條',
        'summaryCssClass'=>'summary_container',
        'pager'=>array(
            'class'=>'CLinkPager',
            'firstPageLabel'=>Yii::t('list','First'),//定义首页按钮的显示文字
            'lastPageLabel'=>Yii::t('list','Last'),//定义末页按钮的显示文字
            'nextPageLabel'=>Yii::t('list','Next'),//定义下一页按钮的显示文字
            'prevPageLabel'=>Yii::t('list','Prev'),//定义上一页按钮的显示文字
			'header'=>'',
            'pageSize'=>'50',
        ),
    ));
        
?>
        
    </div>
    <div class="list_right tab_box_content main-list">
		<div class="title">
			<h1>本月最多點閱</h1>
		</div>
		<div class="list">
        <?php $this->widget(
                        'ext.ArcListWidget',
                        array(
                            'columnId'=>$column->id,
                            'length'=>16,
                            'limit'=>'14',
                            'subDay'=>'30',
                            'showSub'=>true,
                            'orderBy'=>'click_num DESC, publishtime DESC',
                            'actionPath'=>'/moneygod/article',
                            'categoryPath'=>'/moneygod/category',
                            'linkHtmlOptions'=>array('target'=>'_blank'),
                            )
                        ); ?>
        </div>
	</div>
 </div>