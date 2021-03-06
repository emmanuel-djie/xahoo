<?php
class Project extends ProjectBase
{
	
        /**
         * @return array validation rules for model attributes.
         */
        public function rules() {
                //新增的在这里面加，如果修改 需要修改父类中的Rules
                $curRules = array(
                    
                );
                return array_merge(parent::rules(), $curRules);
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
                $curRelations = array(
                    'tpl'=>array(self::HAS_ONE, 'ProjectTpl','','on'=>'t.tpl_id = tpl.id'),
                    'tegory'=>array(self::HAS_ONE, 'ProjectCategory','','on'=>'tegory.ff_item_id = t.ff_item_id'),
                    'info'=>array(self::HAS_MANY, 'ProjectBuildingInfo','','on'=>'t.project_id = info.project_id and info.status=1'),
                    'board'=>array(self::HAS_ONE, 'ProjectBoard','','on'=>'t.project_id = board.project_id'),
                    'video'=>array(self::HAS_ONE, 'ProjectVideo','','on'=>'t.project_id = video.project_id'),
                    'photo'=>array(self::HAS_MANY, 'ProjectPhoto','','on'=>'t.project_id = photo.project_id and photo.status=1','order'=>'photo.id desc'),//项目photo
                    'qcq'=>array(self::HAS_MANY, 'QcqBuilding','','on'=>'t.project_id = qcq.project_id and qcq.status=1'),
                    'qcqtg'=>array(self::HAS_MANY, 'QcqBuildingTg','','on'=>'qcq.building_id = qcqtg.building_id'),
                    'qcqphoto'=>array(self::HAS_MANY, 'QcqPhoto','','on'=>'qcq.building_id = qcqphoto.building_id and qcqphoto.status=1','order'=>'qcqphoto.id desc'),
                    'fq'=>array(self::HAS_MANY, 'FqHouse','','on'=>'t.project_id = fq.project_id and fq.status=1','order'=>'fq.project_sort asc'),
                );
                return array_merge(parent::relations(), $curRelations);
        }

        /**
         * custom defined scope
         * @param  integer $pageNo   页码
         * @param  integer $pageSize 每页大小
         * @return object
         */
        public function pagination($pageNo = 1, $pageSize = 20) {

            $offset = ($pageNo > 1) ? ($pageNo - 1) * $pageSize : 0;
            $limit = ($pageSize > 0) ? $pageSize : 20;

            $this->getDbCriteria()->mergeWith(array('limit' => $limit, 'offset' => $offset));

            return $this;
        }

        /**
         * custom defined scope
         * @param  integer $limit 数量
         * @return object
         */
        public function recently($limit = 5) {

            $this->getDbCriteria()->mergeWith(array('order' => 't.last_modified DESC', 'limit' => $limit));

            return $this;
        }

        /**
         * custom defined scope
         * @param  string $order 排序条件
         * @return object
         */
        public function orderBy($order = 't.last_modified DESC') {

            if (!empty($order)) {
                $this->getDbCriteria()->mergeWith(array('order' => $order));
            }

            return $this;
        }

        /**
         * 与Smarrty中的文本提示相对应，可以修改成中文提示
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels() {
                $curLables = array(
                );
                return array_merge(parent::attributeLabels(), $curLables);
        }
        public function mySearch()
        {
               // @todo Please modify the following code to remove attributes that should not be searched.
                $criteria = $this->getBaseCDbCriteria();
                //为$criteria新增设置
                $count = $this->count($criteria);
                $pager = new CPagination($count);
                $pager->pageSize = !empty(Yii::app()->params['pageSize'])?Yii::app()->params['pageSize']:10;
                $pager->pageVar = 'page'; //修改分页参数，默认为page
                $pager->params = array('type' => 'msg'); //分页中添加其他参数
                $pager->applyLimit($criteria);
                $list = $this->findAll($criteria);
                $pages = array(
                    'curPage' => $pager->currentPage+1,
                    'totalPage' => ceil($pager->itemCount/$pager->pageSize),
                    'pageSize' => $pager->pageSize,
                    'totalCount'=>$pager->itemCount,
                    'url'=>preg_replace("/&page=\d*[^&]/", "", Yii::app()->request->getUrl())."&page=",
                );
                return array('pages' => $pages, 'list' => $list);
        }
        
        public function mySearch2($sql) {
        // @todo Please modify the following code to remove attributes that should not be searched.
        //$criteria = $this->getBaseCDbCriteria();
        //为$criteria新增设置
        //$count = $this->count($criteria);
        $ssql = 't.status=1'.$sql;
        
        $criteria = new CDbCriteria();
        $criteria->join = "JOIN project_category as cat on t.ff_item_id=cat.ff_item_id";
        $criteria->order = 't.project_weight ASC,t.create_time DESC';
        $criteria->addCondition($ssql);      //根据条件查询
        $count = $this->count($criteria);
        
        $pager = new CPagination($count);
        $pager->pageSize = !empty(Yii::app()->params['pageSize']) ? Yii::app()->params['pageSize'] : 10;
        $pager->pageVar = 'page'; //修改分页参数，默认为page
        $pager->params = array('type' => 'msg'); //分页中添加其他参数
        $pager->applyLimit($criteria);
        $list = $this->with('tegory', 'tpl')->orderBy('t.project_weight ASC,t.create_time DESC')->findAll($criteria);
        $pages = array(
            'curPage' => $pager->currentPage + 1,
            'totalPage' => ceil($pager->itemCount / $pager->pageSize),
            'pageSize' => $pager->pageSize,
            'totalCount' => $pager->itemCount,
            'url' => preg_replace("/&page=\d*[^&]/", "", Yii::app()->request->getUrl()) . "&page=",
        );
        return array('pages' => $pages, 'list' => $list);
    }
        
        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return Project the static model class
         */
        public static function model($className=__CLASS__)
        {
                return parent::model($className);
        }
}
