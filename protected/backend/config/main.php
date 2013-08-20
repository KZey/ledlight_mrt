<?php
    // uncomment the following to define a path alias
    // Yii::setPathOfAlias('local','path/to/local-folder');

    // This is the main Web application configuration. Any writable
    // CWebApplication properties can be configured here.

	define('BACKEND_ENTRY_NAME', 'admin.php');
    $backend=dirname(dirname(__FILE__));
    $frontend=dirname($backend);
    Yii::setPathOfAlias('backend',$backend);
//     echo YiiBase::getPathOfAlias('backend');
//     echo '<br/>'.$frontend;
//     Yii::app()->end();
    
    $frontendArray=require_once($frontend.'/config/main.php');
    $backendArray = array(
        'name'=>'MRT Backend System',
    	'defaultController'=>'login',
        'basePath'=>$frontend,
        'viewPath'=>$backend.'/views',
        'controllerPath'=>$backend.'/controllers',
        'runtimePath'=>$backend.'/runtime',
        'import'=>array(
            'application.models.*',
            'application.components.*',
            'application.extensions.upload.*',
            // 'application.admin.models.*',
            'backend.models.*',
            'backend.components.*',
        ),
        'components'=>array(
             'urlManager'=>array(
                'urlFormat'=>'path',
                'urlSuffix'=>null,
                'showScriptName'=>true,
                'rules'=>null,
            ), 
        	
            
        ),
    );
    return CMap::mergeArray($frontendArray,$backendArray);
    
?>