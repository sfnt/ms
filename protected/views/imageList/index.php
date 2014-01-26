<?php
	$this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'viewData'=>array(
            'path'=>$path,
        ),
        'template'=>'<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="table_0" aria-describedby="table_0" style="margin-bottom: 50px;width:99%;">
                        <thead>
        					<tr role="row">
        						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">预览</th>
        						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">点击看大图</th>
        					</tr>
        				</thead>
                        <tbody>{items}</tbody>
                    </table><div class="pagination pagination-centered">{pager}</div>',
        'pagerCssClass'=>'',//定义pager的div容器的class
        'pager'=>array(
            'class'=>'CLinkPager',
            'firstPageLabel'=>Yii::t('list','First'),//定义首页按钮的显示文字
            'lastPageLabel'=>Yii::t('list','Last'),//定义末页按钮的显示文字
            'nextPageLabel'=>Yii::t('list','Next'),//定义下一页按钮的显示文字
            'prevPageLabel'=>Yii::t('list','Prev'),//定义上一页按钮的显示文字
			'header'=>'',
        ),
    ));
?>